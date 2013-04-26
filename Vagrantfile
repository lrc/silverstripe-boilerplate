# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  
  config.vm.box = "lucid64-lamp-gd-curl"
  config.vm.box_url = "//LRCSERVER/Company/Software/VMs/lucid64-lamp-gd-curl.box"
  config.vm.provision :shell, :path => "provision.sh"
  config.vm.hostname = "silverstripe-boilerplate.dev"
  config.vm.network :private_network, ip: "192.168.33.11"

end
