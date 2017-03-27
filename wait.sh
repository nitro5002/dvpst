#!/bin/bash

# works for versions 1, 2 of docker-compose.yml
# in case of usage version 2 add to `environment` variables like
# DB1_TCP=http://server_name:3306

port=${1:-3306}

while IFS=' ' read -ra hosts; do
    for host in "${hosts[@]}"; do
        echo "waiting for TCP connection to $host"
        res=1
        while [ $res -ne 0 ]
        do
            wget -q --tries=10 --timeout=20 -O - $host > /dev/null 2>&1
            res=$?
            echo "."
            sleep 1
        done
    done
done <<< $( (env | grep ${port}_TCP= || env | grep _TCP=) | cut -d / -f 3 )
