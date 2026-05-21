.DEFAULT_GOAL := help
SHELL := /bin/bash

# Allow `make wp -- xxx` to swallow extra args
%:
	@:

include .env
export

.PHONY: help up down restart logs ps shell bootstrap wp db-export db-import clean reset

help: ## List available targets
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS=":.*?## "}; {printf "\033[36m%-14s\033[0m %s\n", $$1, $$2}'

up: ## Start all services in detached mode
	docker compose up -d
	@echo ""
	@echo "  WordPress: http://localhost:8080"
	@echo "  MailHog:   http://localhost:8025"
	@echo "  phpMyAdmin: http://localhost:8081"
	@echo ""

down: ## Stop services (data preserved)
	docker compose down

restart: ## Restart WordPress + Apache
	docker compose restart wordpress

logs: ## Tail WordPress logs
	docker compose logs -f wordpress

ps: ## Show service status
	docker compose ps

shell: ## Open bash shell in WordPress container
	docker compose exec wordpress bash

wp: ## Run WP-CLI command. Usage: make wp -- option get blogname
	docker compose run --rm wpcli $(filter-out $@,$(MAKECMDGOALS))

bootstrap: ## One-time: install WP, set TR lang, activate sazara theme, install plugins
	@echo "Bootstrapping Sazara WordPress install..."
	docker compose run --rm wpcli core install \
		--url="$(WP_SITE_URL)" \
		--title="$(WP_SITE_TITLE)" \
		--admin_user="$(WP_ADMIN_USER)" \
		--admin_password="$(WP_ADMIN_PASSWORD)" \
		--admin_email="$(WP_ADMIN_EMAIL)" \
		--skip-email
	docker compose run --rm wpcli language core install tr_TR
	docker compose run --rm wpcli site switch-language tr_TR
	docker compose run --rm wpcli theme activate sazara
	docker compose run --rm wpcli option update permalink_structure '/%postname%/'
	docker compose run --rm wpcli rewrite flush
	docker compose run --rm wpcli option update timezone_string 'Europe/Istanbul'
	docker compose run --rm wpcli option update date_format 'j F Y'
	docker compose run --rm wpcli option update time_format 'H:i'
	docker compose run --rm wpcli option update start_of_week 1
	@echo ""
	@echo "  Bootstrap complete. Visit $(WP_SITE_URL)/wp-admin"
	@echo "  Run 'make plugins' next to install vitrin plugins."
	@echo ""

plugins: ## Install required plugins (WooCommerce, SEO, security, forms, etc.)
	docker compose run --rm wpcli plugin install \
		woocommerce \
		seo-by-rank-math \
		wordfence \
		wps-hide-login \
		fluentform \
		ewww-image-optimizer \
		updraftplus \
		polylang \
		advanced-custom-fields \
		--activate || true
	@echo ""
	@echo "Configuring WPS Hide Login slug (/sazara-giris/)..."
	docker compose run --rm wpcli option update whl_page sazara-giris 2>/dev/null || true
	@echo ""
	@echo "Suppressing WooCommerce onboarding wizard..."
	docker compose run --rm wpcli option update woocommerce_onboarding_profile '{"completed":true,"skipped":true}' --format=json 2>/dev/null || true
	@echo ""
	@echo "Deactivating Wordfence for local dev (20s+ delays — re-activate in production)..."
	docker compose run --rm wpcli plugin deactivate wordfence 2>/dev/null || true
	@echo ""
	@echo "  Plugin install complete. Active set:"
	docker compose run --rm wpcli plugin list --status=active --field=name 2>/dev/null | grep -v "^ "
	@echo ""
	@echo "  Site:        http://localhost:8080"
	@echo "  Admin:       http://localhost:8080/sazara-giris/"
	@echo "  MailHog:     http://localhost:8025"
	@echo "  phpMyAdmin:  http://localhost:8081"

prod-plugins: ## Production plugin posture — re-activates Wordfence
	docker compose run --rm wpcli plugin activate wordfence

db-export: ## Dump DB to db/dump.sql
	@mkdir -p db
	docker compose exec -T db sh -c 'mariadb-dump --user=root --password="$$MARIADB_ROOT_PASSWORD" --single-transaction --quick --lock-tables=false sazara' > db/dump.sql
	@echo "Exported to db/dump.sql ($$(wc -c < db/dump.sql | xargs) bytes)"

db-import: ## Restore DB from db/dump.sql
	docker compose exec -T db sh -c 'mariadb --user=root --password="$$MARIADB_ROOT_PASSWORD" sazara' < db/dump.sql
	@echo "Imported db/dump.sql"

clean: ## Stop services AND DELETE all data (db, wp core, named volumes)
	@read -p "Bu komut DB'yi ve WP core dosyalarını siler. Emin misin? [y/N] " ans; [[ "$$ans" =~ ^[Yy]$$ ]] && docker compose down -v || echo "Cancelled."

reset: clean up bootstrap plugins ## Full reset: wipe everything and re-bootstrap
