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

