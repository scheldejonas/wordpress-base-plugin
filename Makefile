SHELL := /bin/bash

start:
	echo "Hello new plugin!"

wordpress_start:
	rsync -ahv \
		-e 'sshpass -p "PASSWORD" ssh -p PORT -p StrictHostKeyChecking=no' \
		nbbeskaeftigelse@35.246.186.255:/www/nbbeskaeftigelse_144/public/ .

wordpress_download:
	rsync -ahv \
		-e 'sshpass -p "PASSWORD" ssh -p PORT -p StrictHostKeyChecking=no' \
		--delete \
		--exclude=wp-config* \
		--exclude=.idea* \
		--exclude=Makefile \
		--exclude=wp-content/cache* \
		--exclude=wp-content/advanced-cache.php \
		--exclude=wp-content/wp-rocket-config* \
		--exclude=wp-content/uploads* \
		nbbeskaeftigelse@35.246.186.255:/www/nbbeskaeftigelse_144/public/ .

wordpress_upload:
	rsync -ahv \
		-e 'sshpass -p "PASSWORD" ssh -p PORT -p StrictHostKeyChecking=no' \
		--delete \
		--exclude=wp-config* \
		--exclude=.idea* \
		--exclude=Makefile \
		--exclude=wp-content/cache* \
		--exclude=wp-content/advanced-cache.php \
		--exclude=wp-content/wp-rocket-config* \
		--exclude=wp-content/uploads* \
		./ nbbeskaeftigelse@35.246.186.255:/www/nbbeskaeftigelse_144/public