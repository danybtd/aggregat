
SOURCE_DIR = `pwd`
BIN_DIR = ${SOURCE_DIR}/vendor/bin

LINT_DIR =  ${SOURCE_DIR}/app \

define printSection
	@printf "\033[36m\n==================================================\n\033[0m"
	@printf "\033[36m $1 \033[0m"
	@printf "\033[36m\n==================================================\n\033[0m"
endef

.PHONY: phpstan
phpstan:  ## Lance l'analyse de code
	$(call printSection,PHPSTAN)
	${BIN_DIR}/phpstan.phar analyse -c phpstan.neon.dist --memory-limit=1G

