# QUERO MOO

Projeto completo em PHP + MySQL (XAMPP) para loja de queijos.

## Requisitos
- XAMPP com Apache e MySQL ativos
- PHP 8+ recomendado

## Como rodar no localhost
1. Copie a pasta do projeto para: `C:\xampp\htdocs\queromoo`
2. Crie o banco importando o script SQL:
   - Abra o phpMyAdmin
   - Crie o banco `queromoo` (se nao existir)
   - Importe o arquivo [database/queromoo.sql](database/queromoo.sql)
3. Ajuste a base de URL se necessario:
   - Edite [config/config.php](config/config.php)
   - Defina `base_path` como `/queromoo/public`
4. Acesse no navegador:
   - http://localhost/queromoo/public

## Login admin
- Email: admin@queromoo.com
- Senha: admin123

## Estrutura
- app/ (controllers, models, views)
- core/ (router, database, helpers)
- public/ (front controller, assets)
- config/ (configuracoes)
- database/ (script SQL)

## Observacoes
- O primeiro login transforma a senha admin em hash seguro automaticamente.
- Imagens de produtos sao gravadas em public/uploads.
