## Getting Started

Follow these steps to get your local copy up and running.

### Prerequisites
Ensure you have the following installed on your system:
*   PHP (version >= 8.x, check your project's `composer.json` for the exact requirement)
*   Composer
*   A database server (MySQL)

### Installation

1.  **Clone the repository**:
    ```bash
    git clone https://github.com/reytabs/translation.git
    cd your_project
    ```

2.  **Install PHP dependencies**:
    ```bash
    composer install
    ```

3.  **Copy the environment file**:
    ```bash
    cp .env.example .env
    ```

4.  **Configure your environment**:
    *   Open the newly created `.env` file in your editor.
    *   Update the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` variables to match your local database configuration.

5.  **Generate an application key**:
    ```bash
    php artisan key:generate
    ```

6.  **Run database migrations and seed**:
    ```bash
    php artisan migrate --seed
    ```
    *Note: The `--seed` flag runs the database seeders after migration, populating the database with initial data.*

7.  **Serve the application**:
    ```bash
    php artisan serve
    ```
    Your application should now be accessible at `http://127.0.0.1:8000`.

## Usage

Provide examples of how to use the project, what functionality it offers, or how to log in if authentication is included.

1. **Run passport client password**:
    ```bash
    php artisan passport:client --password
    ```
    *Note: The `command above` will generate the client id/secret that we are going to use for authentication to access the application*
    After, generate please save the client id/secret.

2. **Authentication**:
    To login access the {{your_host}}/oauth/token and replace the generated client id/secret.

    grant_type:password
    client_id:019b300a-8b38-72d0-b02a-90832a62dcec
    client_secret:Al9bhAK3797eytOBgN6HUDeRSkOKb81DnmN512SG
    username:admin@test.com
    password:password
    scope:

3. **Authorization and API Access**
    After access the oauth/token please get the generated accesss token and put it on the headers to access the API.
    
    Authorization:Bearer {{generated_access_token}}
    Content-Type:application/json
    Accept:application/json


## Contact

*   Kevin Rey Tabada - [reytabs1993@gmail.com]
*   Project Link: [https://github.com/reytabs/translation.git]