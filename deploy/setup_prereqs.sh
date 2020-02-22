#! /bin/bash

# --------------------------------------------------------
#            Ubuntu 18.04 Pre-Req Setup
#
#    Installs the pre-reqs for running My Damn Budget
# --------------------------------------------------------


# Let the user know how to actually use this script
print_usage() 
{
        echo ""
        echo "Usage: $0 [OPTIONS]"
        echo "  Install and configure the initial pre-requisites for running"
        echo "  My Damn Budget."
        echo "Required Parameters:"
        echo "   None Currently :)"
        echo ""
        echo "Options:"
        echo "  None currently :)"
        exit 1
}

# Handy function that hides standard output and only
# lets errors/warnings be displayed.
silent() {
  "$@" > /dev/null
}

install_php ()
{
    local rc=0

    # Get the update list of packages
    silent apt-get update -y || rc=$((rc+1))

    # Install apache2, PHP 7.2 and laravel prereqs
    silent apt-get install php7.2 php7.2-zip php7.2-xml php7.2-soap php7.2-pgsql php7.2-mbstring php7.2-intl php7.2-imap php7.2-gd php7.2-fpm php7.2-curl php7.2-bcmath libapache2-mod-php7.2 -y || rc=$((rc+1))

    echo "$rc"
}

install_composer ()
{
    local rc=0
    
    # Download Composer
    silent curl -sS https://getcomposer.org/installer -o composer-setup.php || rc=$((rc+1))

    # Install composer
    silent php composer-setup.php --install-dir=/usr/local/bin --filename=composer || rc=$((rc+1))

    # Delete the temporary setup file
    silent rm composer-setup.php || rc=$((rc+1))

    echo "$rc"
}

# Installs apache2 and it's required components for running
# laravel on a web server.
#   Parameters:
#       1) The port number that API should be listening on
setup_apache ()
{
    local rc=0

    # Enable required modules & config
    silent a2enmod setenvif || rc=$((rc+1))
    # Enable php 7.2 for apache
    silent a2enmod php7.2 || rc=$((rc+1))
    # Enable rewrite module

    silent a2enmod rewrite || rc=$((rc+1))
    silent a2enconf php7.2-fpm || rc=$((rc+1))
    
    # Disable the default apache site
    silent a2dissite 000-default.conf || rc=$((rc+1))
    
    # Restart apache
    silent service apache2 restart || rc=$((rc+1))

    echo "$rc"
}