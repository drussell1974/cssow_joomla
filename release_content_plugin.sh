#!/bin/bash

if [ $# -eq 0 ]
	then echo "Enter the name of the plugin"
else
	sudo cp -r "./public_html/plugins/content/$1/" "/var/www/html/velopoint.co.uk/public_html/plugins/content/"
fi
