You may install the application's dependencies by navigating to the application's directory and executing the following command. This command uses a small Docker container containing PHP and Composer to install the application's dependencies:

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
    

Navigate to the application directory and start Laravel Sail. Laravel Sail provides a simple command-line interface for interacting with Laravel's default Docker configuration:

./vendor/bin/sail up -d

To see all docker containers running:

docker ps -a

Copy the container id of sail-8.0/app image

docker exec -it [id_container] /bin/bash

Now you are inside container instance of sail-8.0/app image:

su sail

Now you can run all php artisan and npm command

For more info on Laravel Sail see: https://laravel.com/docs/8.x/sail

In Laravel it is very easy to integrate a React component thanks to the assets compilation system (mix): https://laravel.com/docs/8.x/mix#react

See file webpack.mix.js into the project. 

The react component is in the folder /resources/js/react-posts/
