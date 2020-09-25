# MiniSys

## Programcsomag webes alkalmazások készítéséhez

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Aktuális verzió: 2020.**
**Első megjelenés: 2018.**


### Telepítés (MiniAdmin, MiniAppFrame)

- felmásolni az összes fájlt a webserver megfelelő könyvtárába
- `config` könyvtár `config.php` fájlátnézése, a beállítások itt taláhatók
- írási jog kell a `config.php` fájlban megadott dokumentum tároló könyvtárra
- `config` könyvtárban találhatók a nyelvi fájlok, ha szükséges a módosítható


### Működés (MiniAdmin, MiniAppFrame)

Az adatok a `config.php` könyvtárban megadott dokumentum könyvtárban tárolódnak,
külön alkönyvtárakban. Ezeket szekcióknak nevezzük.

Indítás:
- felhasználó: `index.html`
- adminisztráció: `admin.html`



# AppMan

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

### Mentés, visszaállítás

Mentés az AppMan jönyvtárában lévő `backup.php` program segítségével lehetséges.
Ha a telepített program használ SQL-t, akkor annak biztosítania kell a mentést
és visszaállítást, egy-egy php fájl segítségével. Ezek a fájlok az `appman_cfg`
fájlban megadhatók, mentés előtt, illetve visszaállítás után lefutnak. Az SQL
mentés nem lehet `.tar.gz` kiterjesztésű, mert az ilyen fájlok nem kerülnek
mentésre.



# SysInfo

Fejlesztés alatt.



# Sys_utils

Eredeti verziója az AppMan csomagnak.
