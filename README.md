# Application

The application run with docker, so you have two ways to build `Dockerfile`.
* You can run `docker image build -t app-checklist-image .`

or specify some args like

* `docker image build -t app-checklist . --build-arg user=matheus --build-arg uid=1000`

After build image, you can run a container `docker container run -d -v $(pwd):/var/www -v $(pwd)/in:/var/lib/app/in -v $(pwd)/out:/var/lib/app/out --name=app-checklist app-checklist-image`

Run some command application `docker exec -it app-checklist bash`. You are on the app folder container,
and can run any command, like `php index.php "13-02-2021.dat"` the application will generate `13-02-2021.out`
on `/var/lib/app/out`.

Still inside container, you can verify the files with `cat /var/lib/app/out/13-02-2021.out`, or
look at on a project folder `out/13-02-2021.out` (look files section).

# Files
### Location are based on [this](https://stackoverflow.com/a/1510352) argument.

Inside the container, the folder witch app runs is `/var/www`.

The entry files must be stored in `/var/lib/app/in` and out files `/var/lib/app/out`.

This folders are binded with `in` and `out` folder on the root folder app.
