Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.provision :shell, path: "vagrant/nginx/bootstrap.sh"
  config.vm.network "public_network", ip: "172.16.11.143"

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
    vb.customize ["modifyvm", :id, "--name", "Dealer Application - Ubuntu 16.04"]
  end
end