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

