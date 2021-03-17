# - * - Modus: Rubin - * -
# vi: setze ft = rubin:

#Box-Settings
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"

#Provider-Settings
config . vm . Netzwerk  " forwarded_port " ,  Gast : 80 ,  Host : 8080 ,  auto_correct : true
config.vm.network "private_network", ip: "192.168.33.10"
config . vm . Anbieter  "virtualbox"  do | vb |
  vb . name  =  "VM-M300-LB02"
  vb . gui  =  wahr
  vb . Speicher  =  "4096"
end


#provision-Settings
config . vm . Bestimmung  "Shell" ,  Inline : << - SHELL
sudo apt-get update
sudo apt-get upgrade

sudo apt-get install apache2 -y

sudo service apache2 restart
sudo service apache2 status