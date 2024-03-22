## Desafio | PHP 🐘| Laravel

**Objetivo**: O desafio é desenvolver um sistema de processamento de pagamentos integrado ao ambiente de homologação do Asaas, levando em consideração que o cliente deve acessar uma página onde irá selecionar a opção de pagamento entre Boleto, Cartão ou Pix.

**Documentação**: https://asaasv3.docs.apiary.io/#

**Credenciais de Sandbox**:

Crie uma conta no Asaas Sandbox( https://sandbox.asaas.com/ ), na parte de Configuração de Conta->Integrações você irá conseguir a API Key de Sandbox para iniciar a integração.

Basicamente, o sistema deve ter a opção do pagamento e um formulário com inputs necessários para processar o pagamento e um botão 'finalizar pagamento', e se o pagamento der certo direcionar para uma página de obrigado.

**O sistema deverá suprir as seguintes necessidades:**

- **O sistema deverá ser desenvolvido utilizando a linguagem PHP no framework Laravel.**

  - Tratar os Dados no Request da requisição para que não aconteça de vir dados faltando ou diferentes do necessário.
  - Resposta da solicitação ser padronizada via Resources conforme o necessário.
  - Padronização das Requisições das APIs de integração com o Asaas.
- Processamento de pagamentos com boleto, cartão de crédito e pix.
  - Se o pagamento for boleto mostrar um botão com o link do boleto na página de obrigado.
  - Se o pagamento for Pix exibir o QRCode e o Copia e Cola na página de obrigado.
  - Em caso de recusa do cartão ou erro na requisição mostrar uma mensagem amigável no retorno para facilitar o entendimento do não processamento do pagamento.
- Não é necessário se importar com a qualidade do front, usar um bootstrap bem básico
- Utilize boas práticas de programação
- Utilize boas práticas de git
- Documentar como rodar o projeto

**Opcionais**:
- [TODO] Testes automatizados com informação da cobertura de testes
- Persistência dos dados em banco de dados relacional, de preferência MySql.

Todo o conhecimento aplicado no Teste será analisado, então não se baseie somente nas necessidades básicas que devem ser atendidas.

## Instruções para rodar o projeto
**Requerimentos:**
1. PHP versão 8.3 ou superior instalado em seu sistema.
2. Composer versão 2 ou superior para instalar as bibliotecas e pacotes necessários para o Laravel.
3. MySQL server instalado e configurado

**Passo a Passo**
1. Faça o clone do repositorio ou o download da aplicação pelo [link](https://github.com/tehcortez/AsaasPaymentSystem/archive/refs/heads/main.zip) e extraia numa pasta;
2. Na pasta raiz do projeto execute o comando:
```
composer install
```
3. Faça uma cópia do arquivo .env.example na raiz do projeto e renomeie-o para .env
5. Abra o arquivo .env e insira seus dados de acesso ao MySQL e sua credencial de acesso ao Asaas (API_KEY):
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_da_database
DB_USERNAME=usuario_mysql
DB_PASSWORD=senha_mysql
```
```
ASAAS_APIKEY=credencial_de_acesso
```
6. Gere uma application key através do comando:
```
php artisan key:generate
```
7. Execute o seguinte comando para criar as tabelas no banco de dados:
```
php artisan migrate
```
8. Inicie um servidor web local através do comando:
```
php artisan serve
```
9. Acesse a aplicação através de qualquer browser pelo link http://localhost:8000/
