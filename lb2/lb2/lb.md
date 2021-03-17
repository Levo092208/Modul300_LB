> TBZ M300 Levin Kuhn

# **Modul 300 Dokumentation**
![Image](desktop/Titelbild.png)







> **Inhaltsverzeichnis**    

- [**Modul 300 Dokumentation**](#modul-300-dokumentation)
    - [**1 Einführung**](#1-einführung)
      - [**1.1 Einleitung**](#11-einleitung)
    - [**2 Technische Doku**](#2-technische-doku)
      - [**2.1 GIT**](#21-git)
      - [**2.2 Vagrant**](#22-vagrant)
    - [**5 Test**](#5-test)
    - [**links**](#links)



### **1 Einführung**
#### **1.1 Einleitung**

Das hier ist die Dokuemntation des Moduls 300, in welchem wir einen Webserver automatisieren werden. Zur Realisierung werden  Git und Markdown wesentlich beitragen und auch hier in der Dokumentation beschrieben werden. Zum einen wird der Code beschrieben, mit welchem wir alles aufegsetzt haben und zum anderen werden auch Fortschritte hier verzeichnet.


### **2 Technische Doku**
#### **2.1 GIT**

Als aller erstes haben wir ein Git Repository erstellt und dies geklont. Um das zu tun habe ich die Anelitung unter folgendem Link verwendet: <https://github.com/mc-b/M300/tree/master/10-Toolumgebung>

Nun habe ich das Repository lokal geklont und bin in der Lage, meine lokale Arbeit via ***git push*** ins Repository hoch zu laden. Dafür muss man im CMD zum Verzeichnis wechseln in welchem das Repository geklont wurde.
Jetzt kann ich den befehl ***git status*** ausführen. Nun sehe ich alle Dateien, in welchen etwas geändert wurde. Mit dem Befehl ***git add -A*** kann ich nun alle Dateien zum Upload bereitstellen. Führt man jetzt erneut einen ***git status*** aus so sind alle vorhin rot markierten Dateien nun grün, was heisst, dass der Upload nun gestartet werden kann. Danach kann der Befehl ***git commit -m "Mein Kommentar"*** ausgeführt werden. Dieser "erlaubt" den Upload und hinterlässt einen Kommentar, welchen den neuen oder geänderten Inhalt des Dokuemnts gut beschreiben sollte. An dieser stelle habe ich erneut einen ***git status*** gemacht, welcher mir nun anzeigt, dass Dateien zum pushen bereit sind. Jetzt konnte ich den Befehl ***git push*** ausführen und auf meinem Repository sehen, dass sich was geändert hat.

>Ergänzung: falls mehrere Branches verwendet werden -> git checkout -> git push -u origin "branchname"




#### **2.2 Vagrant**

Im zweiten vorbereitungsschritt habe ich Vagrant kennengelernt. Vagrant ist eine Openn-Source Ruby-Anwendunng, welche zur Erstellung und Verwaltung von VM's gebraucht werden kann. Auch hier wurde folgende Anleitung benutzt:<https://github.com/mc-b/M300/tree/master/10-Toolumgebung>

Als erstes habe ich mir eine Vangrant Box heruntergeladen: <https://app.vagrantup.com/boxes/search?utf8=%E2%9C%93&sort=downloads&provider=&q=ubuntu%2Ftrusty64>

Danach habe ich sichergestellt, dass ich im richtigen Verzeichnis unterwegs bin. Nun habe ich einen ***vagrant init ubuntu/trusty64*** ausgeführt, welchen mir ein Vagrantfile erstellt. Mit Hilfe dieses Vagrantfile kann ich nun die VM weiter erstellen und konfigurieren unnd alles andere aufsetzen. Anschliessend habe ich das Vagrant file geöffnet und alles gelöscht bis auf:       Vagrant.configure("2") do |config|
config.vm.box = "ubuntu/trusty64"
end.
Diese drei Zeilen würden beim auslösen des Bfehels ***vagrant up*** nun eine VM erstellen. Weil wir dies aber nicht wollen, fahren wir mit dem nächsten Teil, der Konfiguration fort.

444
222222222




### **5 Test**
|Test NR | Beschreib | Auswertung |
------ | ------|----------
1      | wir machen...     | geklappt
2      | wir machen...   | (
3      |       | ^  


### **links**
- <https://github.com/Levo092208/Modul300_LB> "Mein Repo"
- <https://app.vagrantup.com/boxes/search?utf8=%E2%9C%93&sort=downloads&provider=&q=ubuntu%2Ftrusty64> "UbuntuBox"
- <https://bscw.tbz.ch/bscw/bscw.cgi/d32655651/M300_LB2_IaC_1_4.pdf> "LB2 Anforderungen"
- <https://stackoverflow.com/questions/4181861/message-src-refspec-master-does-not-match-any-when-pushing-commits-in-git> "Stackflow Lösungsvorschläge"