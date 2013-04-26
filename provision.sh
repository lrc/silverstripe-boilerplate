#!/bin/bash

## Put the project root at site root
echo "Linking /vagrant to /var/www"
rm -rf /var/www
ln -fs /vagrant /var/www
