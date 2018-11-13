#!/bin/bash

if [ $# -eq 0 ]
	then echo "Enter the name of the plugin"
else
	echo "1. Creating zip in dev... com_$1.zip"
        sudo zip -r "src/com_$1.zip" "src/$1"
	

	echo "2. Copy component files to site plugins directory..."
	sudo mkdir "/opt/lampp/htdocs/webalizer/plugins/content/$1"
	sudo cp -r "./src/$1/" "/opt/lampp/htdocs/webalizer/plugins/content"
	sudo chown -R daemon:daemon "/opt/lampp/htdocs/webalizer/plugins/content/$1"
        sudo ls -l "/opt/lampp/htdocs/webalizer/htdocs/webalizer/plugins/content/$1"


	#echo "2. Zip component to site tmp"
	
	#sudo zip -r "/opt/lampp/htdocs/webalizer/tmp/com_$1.zip" "src/$1"
	#sudo chown -R daemon:daemon "/opt/lampp/htdocs/webalizer/tmp/$1"
	#echo "Check permissions..."
	#sudo ls -l "/opt/lampp/htdocs/webalizer/tmp/$1"
	
	echo "Complete!"
fi
