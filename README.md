# Symfony Boilerplate

This is a starter pack for Symfony with Docker, Mariadb and Materialize

## Install

If you want to use docker please follow those instructions

```bash
cp .env.dist .env
docker-compose up -d --build
docker-compose exec php bash # Or ZSH
```

Then just do things as usual ;) PHP container come with composer and git.