# dvpst

Application provides list of users in json format.

Technologies:

- Slim framework
- Docker
- Docker Composer
- PHPUnit Tests
- Composer
- Nginx
- PHP-FPM 5.6
- HAProxy

## Development

Use `docker-compose.yml` to run an application.

```bash
docker-compose up -d
```

Init database:
```bash
cat DDL/initdb.sql | docker exec -i db mysql -uroot -proot
```

Access to application via http requests to `http://192.168.99.100/users` (in case using docker toolbox)

## Tests

Use `docker-compose-test.yml` to run tests.

```bash
 docker-compose -f docker-compose-test.yml up --abort-on-container-exit
```

## Deployment

#### Use Jenkins/Bamboo (CI) + GitLab/Stash (git server)

Setup post push hook in git server to trigger CI plan to run tests for each branch.
If tests are successful - push new image to docker hub and allow user to merge this pull request in UI of git server.

To deploy to production/staging/qa run CI plan with modified docker-compose for this project.
Inside production CI plan will be:
 - Upload mounted files (config for haproxy, docker-compose.yml) to predefined server with proper user and running docker service.
 - On server run: 
```bash
docker-compose pull
docker-compose up -d
docker-compose scale dvpst=2
# this is for load balancer proper start
docker-compose up -d --force-recreate
```

#### First time server setup:

To setup server first time you should:
 - install and run docker service (based on OS type)
 - create proper ssh user for CI app (based on CI app)
 - create predefined folders to mount data (logs, app outputs, database data)

#### Ansible

To deploy app to different server you can use Ansible with configuration from `server_setup` folder

```bash
bash server_setup/deploy.sh production
```