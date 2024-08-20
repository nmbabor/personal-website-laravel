# Personal Website

This is a personal website built using the [Laravel](https://laravel.com/) framework. The website showcases my portfolio, skills, blog, and contact information.

## Features

- **Home Page**: A brief introduction and links to different sections.
- **Portfolio**: A showcase of projects I've worked on, including descriptions and links.
- **Blog**: A collection of articles and tutorials I've written.
- **Contact**: A contact form to get in touch with me.

## Installation

To get started with the project, follow these steps:

1. **Clone the repository**:
    ```bash
    git clone https://github.com/nmbabor/personal-website-laravel.git
    cd personal-website-laravel
    ```

2. **Install dependencies**:
    ```bash
    composer install
    ```

3. **Set up environment variables**:
    - Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```
    - Update the `.env` file with your database and other environment details.

4. **Generate application key**:
    ```bash
    php artisan key:generate
    ```

5. **Run migrations**:
    ```bash
    php artisan migrate
    ```

6. **Start the development server**:
    ```bash
    php artisan serve
    ```

The website should now be running at [http://localhost:8000](http://localhost:8000).

## Usage

- **Add Portfolio Items**: Add new projects to the portfolio by updating the database or using the built-in admin interface.
- **Write Blog Posts**: Create new blog posts through the admin panel or by directly adding them to the database.
- **Customize**: Update the views, styles, and other assets to match your personal branding.

## Contributing

If you would like to contribute to this project, feel free to submit a pull request or open an issue with suggestions.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Contact

If you have any questions or suggestions, feel free to reach out to me via [nmbabor50@gmail.com](mailto:nmbabor50@gmail.com).

