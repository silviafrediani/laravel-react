<h2>Installing Composer Dependencies For Existing Applications</h2>

If you are developing an application with a team, you may not be the one that initially creates the Laravel application. Therefore, none of the application's Composer dependencies, including Sail, will be installed after you clone the application's repository to your local computer.

You may install the application's dependencies by navigating to the application's directory and executing the following command. This command uses a small Docker container containing PHP and Composer to install the application's dependencies:

<code>docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs</code>
    
<h2>Start all Docker Containers</h2>
Now navigate to the application directory and start Laravel Sail. Laravel Sail provides a simple command-line interface for interacting with Laravel's default Docker configuration (for more info on Laravel Sail see: https://laravel.com/docs/8.x/sail):

<code>./vendor/bin/sail up -d</code>

To see all docker containers running:

<code>docker ps -a</code>

Copy the container id of sail-8.0/app image

<code>docker exec -it [id_container] /bin/bash</code>

<h2>Inside Sail Container</h2>
Now you are inside container instance of sail-8.0/app image:

<code>su sail</code>

Now you can run all php artisan and npm command

<code>php artisan migrate --seed</code>

<code>npm install && npm run dev</code>

<h2>Laravel & React</h2>
In Laravel it is very easy to integrate a React component thanks to the assets compilation system (mix): https://laravel.com/docs/8.x/mix#react

See file webpack.mix.js into the project. 

The react component is in the folder /resources/js/react-posts/
