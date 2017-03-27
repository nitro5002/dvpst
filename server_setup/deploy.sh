#!/bin/bash

# environment
env=${1:-develop}

ANSIBLE_HOST_KEY_CHECKING=false ansible-playbook app.yml -i inventories/${env}