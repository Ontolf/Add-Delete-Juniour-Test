# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "generic/alpine313"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
   config.vm.network "private_network", ip: "192.168.56.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
   config.vm.synced_folder "./src", "/vagrant_data"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
  # documentation for more information about their specific syntax and use.
   config.vm.provision "shell", inline: <<-SHELL
     echo -e "http://uk.alpinelinux.org/alpine/v3.13/main/" | tee -a /etc/apk/repositories &&
     echo -e "http://uk.alpinelinux.org/alpine/v3.13/community/" | tee -a /etc/apk/repositories &&
     echo -e "http://mirror.uepg.br/alpine/v3.13/main" | tee -a /etc/apk/repositories &&
     echo -e "http://mirror.uepg.br/alpine/v3.13/community/" | tee -a /etc/apk/repositories &&
     apk update &&
     apk add nginx micro php7 php7-fpm mysql mysql-client php7-pdo php7-pdo_mysql php7-json php7-session &&
     apk add nodejs npm &&
     npm install -g typescript &&

     mysql_install_db --user=mysql --datadir=/var/lib/mysql &&
     rc-service mariadb start &&
     mysqladmin -u root password toor &&

     mysql -uroot -ptoor -e "
        CREATE USER 'root'@'%' IDENTIFIED BY 'root';
        GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';
        FLUSH PRIVILEGES;
     " &&

     cp /vagrant_data/mariadb-server.cnf /etc/my.cnf.d &&
     cp /vagrant_data/nginx.conf /etc/nginx &&
     cp /vagrant_data/php.ini /etc/php &&

     rc-service mariadb restart &&
     rc-update add mariadb default &&


     rc-update add nginx default &&

     rc-service php-fpm7 start &&
     rc-update add php-fpm7 default &&

     cd ../../vagrant_data/app/frontend &&
     tsc

   SHELL
end