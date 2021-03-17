# - * - Modus: Rubin - * -
# vi: setze ft = rubin:

# Box-Einstellungen
Vagrant . configure ( "2" )  do | config |
  config . vm . box  =  "ubuntu / trusty64"

# Provider-Einstellungen
config . vm . Netzwerk  "private_network" ,  IP : "192.168.33.10"
config  .  vm  .  Angebote   "virtualbox"   do | vb |
  vb  .  name   =   "VM-M300-LB02"
  vb  .  gui   =   wahr
  vb  .  Speicher   =   "4096"
end

config . vm . Netzwerk  "forwarded_port" ,  Gast : 80 ,  Host : 8080


# Provision-Einstellungen
config  .  vm  .  Bestimmung   "Shell"  ,   Inline : << - SHELL
sudo  apt Update
sudo  apt Upgrade

sudo  apt install  apache2 - y

sudo ufw app list
sudo ufw allow 'Apache'

sudo systemctl restart apache2
sudo systemctl status apache2
end