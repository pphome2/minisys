# MiniSys

## Programcsomag webes alkalmazások készítéséhez

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Aktuális verzió: 2023.**
**Első megjelenés: 2018.**


### Telepítés (MiniAdmin, MiniAppFrame)

- felmásolni az összes fájlt a webserver megfelelő könyvtárába
- `config` könyvtár `config.php` fájlátnézése, a beállítások itt taláhatók
- írási jog kell a `config.php` fájlban megadott dokumentum tároló könyvtárra
- `config` könyvtárban találhatók a nyelvi fájlok, ha szükséges a módosítható
- sql beállítások a `config.php` fájlban

### Működés (MiniAdmin, MiniAppFrame)

Az adatok a `config.php` könyvtárban megadott dokumentum könyvtárban tárolódnak,
külön alkönyvtárakban. Ezeket szekcióknak nevezzük.

Indítás:
- felhasználó: `index.html`
- adminisztráció: `admin.html`



# AppMan

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Aktuális verzió: 2020.**

Egyszerű telepítő és frissítő program webes alkalmazásokhoz.

### Működés

Az `install.php` letöltése és felmásolása a webtárhelyre. (A fájlon
beül kell tárolni a telepítőprogram csomag (`appman.tar.gz`) elérési
útját és a telepítendő alkalmazás elérési útját (szintén `.tar.gz`)

A tömörített fájlokban figyelni kell a jogosultságok és a tulajdonos
beállítására, mert gondokat okozhat. Az adatkönyvtárhoz (állítható) 
írási jog kell.

Az `install.php` letölti a telepítőprogramot és el is indítja. A telepítő
letölti a megadott alklamazást tartalmazó tömörített fájlt, majd telepíti
az alkalmazást. Lehetőség van a beállítások szerkesztésére. A beállításokat 
tartalmazó fájlt az `appman_cfg.php` fájlban kelll megadni.

Frissítés az AppMan alkönyvtárban lévő `update.php` indításával lehetséges.
A frissítés végeztével javíthatjuk a beállításokat. A korábbi beállításokat
a frissítő program elmenti és az új beállítások megadásánál megjeleníti.

A a beállítások kezelése telepítés, frissítés után indítható. De a `config.php`
önállóan is indítható és kezelhetőek a beállítások. Lehetőség van a rendszernek
eleve megadott beállításfájlon kívül egyedileg megadott fájl kezelésére is:
`config.php?f=config/sajat.php`. Ekkor a megadott fájl kerül feldolgozásra.
A fájl megadásánál a telepítés alapkönyvtárából kell kiindulni, nem kell az
`appman` könyvtárhoz viszonyított elérési út.

A beállításfájl tartalma: `$mezőnév="szöveg"; # Cím`, soronként. A cím jelenik
meg a képrenyőn, a `szöveg` módosítható.


### Mentés, visszaállítás

Mentés az AppMan könyvtárában lévő `backup.php` program segítségével lehetséges.
Ha a telepített program használ SQL-t, akkor annak biztosítania kell a mentést
és visszaállítást, egy-egy php fájl segítségével. Ezek a fájlok az `appman_cfg`
fájlban megadhatók, mentés előtt, illetve visszaállítás után lefutnak. Az SQL
mentés nem lehet `.tar.gz` kiterjesztésű, mert az ilyen fájlok nem kerülnek
mentésre.



# SysInfo

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Aktuális verzió: 2020.**


A program lekérdezi a rendszeradatokat és megjeleníti a log-ban található hibákat,
figyelmeztetéseket. A alapvető redszeradatok mellett lehetőség van időzítve shell 
script segítségével adatfájlba rakni a megjeleníteni kívánt rendszer specifikus 
adatokat. ('sysinfo_cfg.php' fájlban állítható)

Nem elérhető a rendszerlog esetén, `cron` időzítővel és shell script segítségével
lehet összeszedni a log-okat, a programnak pedig be lehet állítani mit tekint
log-fájlnak. ('sysinfo_cfg.php' fájlban állítható) Alapértelmezetten webes felhasználó
nem olvashatja a log fájlokat. Biztosági okokból nem adunk plusz jogokat sem a webes
felhasználónak, sem pedig a rendszerkönyvtáraknak. (Pl.: `/etc/cron.d` könyvtárba egy
`log` nevű fájlt elhelyezni, melynek tartalma: 
`*/5 * * * *     root   /usr/bin/tail -2000 /var/log/syslog > /var/www/html/sysinfo/messages`
Így 5 percenként a syslog utolsó sorairól másolat kerül a SysInfo program könyvtárába és
meg tudja azt jeleníteni. )

Emellett saját log fájl is összeállítható megjelenítésre. ('sysinfo_cfg.php' 
fájlban állítható). Ez a lehetőség akkor hasznos, ha több nem rendszer vagy külön 
kezelt log fájlt akarunk megfigyelni. (pl: Apache, MariaDB...)



# Cockpit-plugin-servre

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Aktuális verzió: 2021.**

`cockpit-project.org` Cockpit program alá készült plugin. Egyedileg testre kell szabni.
Két funkciót tud: fájl tartalmát írja ki (pl.: egy shell script által elkészített
log fájlt), és/vagy shell parancsot tud futtatni (pl.: shell script ami a szerveren 
végez feladatokat). Alapvetően a saját fejlesztések adatainak megjelenítését segíti a 
Cockpit rendszeren belül.




# NVR

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Aktuális verzió: 2021.**

Raspberry Pi használata biztonsági kamera rögzítőnek. Ehhez a Linux alaprendzser
`motion` programját használjuk, ami rögzíti a mozgásokat. Ez a program web-es felületet
biztosítít a rögzített fájlok kezeléséhez.

A rögzítés ki- és bekapcsolásához, valamint az időzítésekhez egy időszakos ellenőrző 
script-et használhatunk, amit `cron`-ból futtatunk. A rögzített fájlok naponkénti 
tárolását egy `cron`-ból futtatott script végzi. A program három előző napot tárol.





# Sys_utils

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Eredeti megjelenés: 2018.**

Eredeti verziója az AppMan csomagnak.
