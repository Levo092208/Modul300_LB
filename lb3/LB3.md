> M300 LB03 Dokuemntation - Arbeiten mit Docker - Levin Kuhn

# **Modul300 Dokumentation der LB03 Docker**


   
    
     
> **Inhaltsverzeichnis**    

- [**Modul300 Dokumentation der LB03 Docker**](#modul300-dokumentation-der-lb03-docker)
- [**1 Einführung**](#1-einführung)
  - [**1.1 Einleitung**](#11-einleitung)
  - [**1.2 Was ist Docker?**](#12-was-ist-docker)
  - [**1.2 Wichtige Befehle und deren Bedeutung Images Docker**](#12-wichtige-befehle-und-deren-bedeutung-images-docker)
  - [**1.2 Wichtige Befehle und deren Bedeutung Container Docker**](#12-wichtige-befehle-und-deren-bedeutung-container-docker)
- [**2 Code Dokumentation**](#2-code-dokumentation)
  - [**2.1 Dockerfile am anfang ohne docker-compose**](#21-dockerfile-am-anfang-ohne-docker-compose)
  - [**2.2 index.php File**](#22-indexphp-file)
  - [**2.3 Apache**](#23-apache)
  - [**2.1 docker-compose.yml**](#21-docker-composeyml)
    - [**2.4 Vagrantfile Codedokumantation VM**](#24-vagrantfile-codedokumantation-vm)
    - [**2.5 Vagrantfile Codedokumantation Apache 2 / php**](#25-vagrantfile-codedokumantation-apache-2--php)
    - [**2.6 Vagrantfile Codedokumantation Firewall**](#26-vagrantfile-codedokumantation-firewall)
- [**3 Erweiterungen**](#3-erweiterungen)
- [**4 Sicherheit**](#4-sicherheit)
- [**5 Tests**](#5-tests)
- [**6 Reflektion**](#6-reflektion)
- [**7 Quellen**](#7-quellen)

---------------------



# **1 Einführung**  

## **1.1 Einleitung**

Das hier ist die Dokuemntation des Moduls 300 der LB03, in welchem wir Services mit Docker autmoatisieren werden. Zur Realisierung wird Docker und Markdown verwendet. Markdown haben wir bereits kennengelernt und wird hier nicht mehr beschrieben. Docker hingegn ist neu und wird auch hier in der Dokumenntation  Zum einen wird der Code beschrieben, mit welchem wir alles aufegsetzt haben und zum anderen werden auch Fortschritte hier verzeichnet.

Ich habe mich dazu entschieden mit Hilfe von PHP, MYSQl und Apache, eine kleine Website zu "bauen", welche ihre Informationen via DB abholt. Was genau auf der Website stehen soll ist noch nicht definiert. 

## **1.2 Was ist Docker?**

„Docker“ ist eine Containerisierungstechnologie, die die Erstellung und den Betrieb von Linux-Containern ermöglicht. 

## **1.2 Wichtige Befehle und deren Bedeutung Images Docker**

- ***build*** = Image erstellen
- ***pull*** = Image oder Repo von Registry ziehen
- ***ls*** = zeigt alle vorhandenen Images
- ***history*** = Alle Infos von einem Image
- ***inspect*** = Detailiertere Infos zu Image, was geschieht auf welchem Layer
- ***rmi*** = Image Löschen

## **1.2 Wichtige Befehle und deren Bedeutung Container Docker**
- ***create*** = Container aus Image erstellen
- ***start*** = existierenden Container starten
- ***run*** = erstellt neuen Container und startet ihn zugleich
- ***ls*** = listet alle *LAUFENDEN* Container auf
- ***inspect*** = Detailierte Infos über Container
- ***logs*** = zeigt logs an
- ***stop*** = stoppt laufenden Container
- ***kill*** = Stoppt Hauptprozess in einem Containner sofort
- ***rm*** = löscht einen gestoppten container

--------------------

# **2 Code Dokumentation**

## **2.1 Dockerfile am anfang ohne docker-compose**

    FROM php:7.4-cli
  >*zuerst wurde dieser Eintrag im Dockerfile benutzt. Im grunde sagt dies es soll die nachfolgenden zeilen von php 7.4 holen*

    COPY . /usr/src/myapp
  >*Hier wird der Kontent der momentan laufenden Directory in das ensprechende Verzeichnis (Docker Container) kopiert.*
    
    WORKDIR /usr/src/myapp
  >*Diese Linie sagt dass "/usr/src/myapp" als "arbeitendes Verzeichnis" läuft also als würde man cd "zu/meinem/projekt" machen.*

    CMD [ "php", "./index.php" ]
  >*Diese Linie Sagt, dass wir das File "index.php" im Ornder "/usr/src/myapp" ausführen, welches dann unser PHP script anzeigt.*


## **2.2 index.php File**

    <?php
  >*Hier sagen wir dem File das der folgende Code in PHP geschrieben wird*

    echo "Hello from the docker m300 container"
  >*Mit einem "echo" können wir eine kleiner Ausgabe schreiben, welche dann auf der Website erscheint.*


**Danach wurden die folgenden Commands ausgeführt:**

    docker build -t my-php-app .
  >*Diese Zeile sagt es soll unser neues Image namens "my-php-app" mit Hilfe des Inhalts der momentan befinden directory kreieren.*

    docker run -it --rm --name my-running-app my-php-app
 >*Diese Zeile sagt es soll einen Container kreieren, welcher auf dem neu erstellten Image basiert.*

 **Nun sollte man so etwas heruas bekommen:**
 
    Hello from the docker container


## **2.3 Apache**

    docker run -d -p 80:80 --name my-apache-php-app -v "$PWD":/var/www/html php:7.2-apache
>*Diese Zeile sag, dass Apache aus dem aktzuellen Folder gestartet werden soll und es definiert noch welche verison wir für den Apache Webserver nehmen "7.2"*


Wenn wir nun http://localhost:80 aufrufen sollten wir dies bekommen:

![image](./php-docker/localhost.jpg)



***Im nächsten Schritt wird beschrieben, wie es mit eienem Docker-compose file funktioniert, und dies ist auch die Varianten für welche ich mich schlussendlich auch entschiednen habe.***

---------------------------                                                                            
## **2.1 docker-compose.yml**                



---------------------------



### **2.4 Vagrantfile Codedokumantation VM**

     config.vm.box = "ubuntu/xenial64"
  >*hier ist definiert, welche Image / Box verwendet werden soll*

     config.vm.network "forwarded_port", guest: 80, host: 8080
  >*hier werden die geöffneten Ports eingetragen, damit man später auf die VM zugreifen kann*

     config.vm.synced_folder ".", "/var/www/html"
  >*hier wird definiert ob ein Ordner synchronisiert werden soll*


     config.vm.provider "virtualbox" do |vb|
  >*hier wird definiert welcher Provider verwendet werden soll*

     
     vb.memory = "4096"
  >*hier wird definiert wie viel Speicher die VM haben soll*

     config.vm.provision "file", source: "../Website/index.php", destination: "/var/www/html/index.php"
  >*hier sagen wir das alles was in Website/index.php steht soll auch zu html/index.php geschickt werden*
  >> *index.php wurde lokal mit html bearbeitet*

     config.vm.provision "file", source: "../Website/.htpasswd", destination: "/var/www/html/.htpasswd"
  >*hier sagen wir das alles was in Website/.htpasswd steht soll auch zu html/.htpasswd geschickt werden*
  >> *.htpasswd wurde bearbeitet. Inhalt = Levo97:$apr1$z0uxpvdg$ICcQCVvMs8oWfiKYRc/J71   jedoch konnte es nicht in Website eingefügt werden aus zeitgründen*

     config.vm.provision "file", source: "../Website/.htaccess", destination: "/var/www/html/.htaccess"
  >*hier sagen wir das alles was in Website/.htaccess steht soll auch zu html/.htaccess geschickt werden*
  >> *.htaccess wurde bearbeitet. Inhalt = AuthType Basic AuthName "Bitte Passwort eingeben" AuthUserFile /Users/levinkuhn/desktop/m300/Modul300_LB/lb2/website/.htpasswd Require valid-user   jedoch konnte es nicht in Website eingefügt werden aus zeitgründen*

     config.vm.provision "file", source: "../Website/apache2.conf", destination: "/var/www/html/apache2.conf"
  >*hier sagen wir das alles was in Website/.htpasswd steht soll auch zu html/.htpasswd geschickt werden*
  >> *apache2.conf wurde bearbeitet. Inhalt = AllowOverWrite - All*

     config.vm.provision "shell", inline: <<-SHELL
    Diese Zeile ist das Schlusslicht und alles wass noch folgt wird erst nach dem Start der VM in der VM automatisch ausgeführt
---------------------------



### **2.5 Vagrantfile Codedokumantation Apache 2 / php**

     apt-get update
  >*durch diesen Befehl werden Paketlisten neu eingelesen und aktualisiert*

     apt-get install -y apache2
  >*durch diesen Befehl wird apache2 installiert*

     sudo apt -y install apache2 php libapache2-mod-php
  >*durch diesen Befehl wird php installiert*

    Nun kann man die IP der VM 127.0.0.1 im Browser eingeben. Wen die php selbt erstellte Seite erscheint hat alles funktioniert.
---------------------------




### **2.6 Vagrantfile Codedokumantation Firewall**
 
    sudo apt install ufw 
  >*durch diesen Befehl wird die ufw installiert, falls sie es nicht bereits ist.*

    sudo ufw default deny incoming
  >*durch diesen Befehl wird standardmässig eingestellt, dass alles was hereinkommt, geblockt werden soll*

    sudo ufw default allow outgoing
  >*durch diesen Befehl wird standardmässig eingestellt, dass alles was rausgeht, erlaubt werden soll*

    sudo ufw allow ssh
  >*eingehende ssh verbindungen werden zugelassen*

    sudo ufw allow 80
  >*Verbindungen des Port 80 werden zugelassen*

    sudo ufw allow 8080
  >*8080 wird zugelassen*
   
    sudo ufw allow 'Apache'
  >*Apache wird zugelassen*

    sudo ufw --force enable
  >*Mit diesem befehl wird die Firewall aktiviert*

    sudo ufw --force status verbose
  >*Mit diesem befehl werden die geänderten Einstellungen angezeigt*

---------------------------

# **3 Erweiterungen**


     sudo apt-get update
     sudo apt-get install libcap2-bin wireshark
  >*durch diesen Befehl werden Paketlisten neu eingelesen und aktualisiert. Zusätzlich wird Wireshark installiert*

     sudo apt-get update
     sudo apt install software-properties-common
     sudo add-apt-repository ppa:deadsnakes/ppa
     sudo apt-get update
     sudo apt install python3.8
  >*durch diesen Befehl werden Paketlisten neu eingelesen und aktualisiert. Zusätzlich wird python installiert*

---------------------------

# **4 Sicherheit**

>Eigentlich sollte .htaccess und .htpasswd für den sichehitsaspekt sorgen, jedoch hatte ich probleme, warum es jetzt nur die Firewall ist, welche uns ein wenig Sicherheit gibt.

---------------------------

# **5 Tests**

| Test  | Beschreib     | Auswertung |
| ------- | ------------- | ---------- |
| 1       | Nur Vm erstellen | geklappt   |
| 2       | Konfigurierte VM erstellen |      geklappt   |
| 3       | Komplettes Vagrant UP              | geklappt      |
| 4       | Webserver im Browser erreichbar (127.0.0.1.8080)              | geklappt      |
| 5       | status ufw              | geklappt      |
| 6       | php website             | geklappt      |
| 7       | php website mit index.php            | geklappt      |


---------------------------

# **6 Reflektion**

>Im grunde fand ich dieses Modul eines von den interessanteren, da ich mich zu anfangs noch gar nicht ausgekannt habe. Durch das Internet und Foren konnte ich mich gut einlesen. Nachdem ich mich informiert habe, und mich langsam in das Thema reingeabeitet habe bekam ich richtig lust zu Arebiten. Auch das Dokumentieren mit Mardwon hat spass gemacht und ich konnte sehr viel aus diesem Projekt lernen. Zum Einen habe ich neues dazu gelernt zum anderen habe ich aber auch gelernt, dass es wichtig ist nicht immer gleich aufzugeben und einfach das beste daraus zu machen. Durch einige Problem konnte ich mein Projekt schlussendlich nicht ganz fertig stellen. Das Nächste mal werde ich allgemein mehr zeit für Vagrant-Konfigurationen einplanen um so mein projekt auch ganz abschliessen zu können. Ich kann also sagen ich hab fast alles erreicht was ich erreichen wollte und bin im Grunde zufrieden mit meinem Projekt.

---------------------------

# **7 Quellen**
- <https://github.com/Levo092208/Modul300_LB> "Mein Repo"
- <https://app.vagrantup.com/boxes/search?utf8=%E2%9C%93&sort=downloads&provider=&q=ubuntu%2Ftrusty64> "UbuntuBox"
- <https://bscw.tbz.ch/bscw/bscw.cgi/d32655651/M300_LB2_IaC_1_4.pdf> "LB2 Anforderungen"
- <https://stackoverflow.com/questions/4181861/message-src-refspec-master-does-not-match-any-when-pushing-commits-in-git> "Stackflow Lösungsvorschläge"
- <https://laracasts.com/discuss/channels/general-discussion/htaccess-and-vagrant> ".htaccess mit Vagrant"

