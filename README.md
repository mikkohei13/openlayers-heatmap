# Openlayers Heatmap

Sovellus, joka lukee dataa tekstitiedostosta ja näyttää sen heatmappina ('lämpökarttana') openlayers-karttasovelluksella.

Data tallennetaan tekstitiedostona 'data'-hakemistoon. Tekstitiedoston nimi annetaan sovellukselle GET-parametrina 's'. Data on tiedostossa kolmessa sarakkeessa: lukumäärä, latitude, longitude. Koordinaattien tulee olla wgs84-muodossa desimaaliasteina, desimaalierottimena piste.

Esim.
	http://EXAMPLE.COM/openlayers-heatmap/?s=lancol_lintu_kesa_2000-2014

Yksilömäärän mukaan skaalattu kartta: lisää parametri scale, esim. 
	http://EXAMPLE.COM/openlayers-heatmap/?s=lancol_lintu_kesa_2000-2014&scale

Pistekartta: lisää parametri dot, esim. 
	http://EXAMPLE.COM/openlayers-heatmap/?s=lancol_lintu_kesa_2000-2014&dot


## Tiira-datan muuntaminen

Krtoilla voi näyttää esim. Tiira-palvelun lintuhavaintodataa. Data on ensin muutettava em. muotoon.

Tiirassa koordinaatit ovat ETRS-TM35FIN (eli EUREF) -muodossa desimaalilukuina, itäkoordinaatti ensin.

### Muunna data näin:

- Vie Tiirasta saatu data Open Refineen Excel-muodossa (tekstimuodossa importointi voi kadottaa osan havainnoista)
	- Korvaa datatiedostosta tabulaattorit välilyönnillä
	- Korvaa #-merkit tabulaattorilla
	- Copy-paste data Exceliin, tallenna .xls-muodossa
	- Importoi data Open Refineen
- Aja conversion-kansiossa oleva muunnos Prepare_coordinates_and_count.json. Tämä muuntaa koordinaatit ja yksilömäärän helposti jatkokäsiteltävään muotoon.
- Suodata tai poista rivit, joita et halua mukaan (epätarkat koordinaatit, päivämäärän perusteella, muuttavat vs. paikalliset...).
	- Jos haluat ottaa mukaan vain tiettyjen kuukausien (esim. kesä- ja heinäkuun) datan, aja muunnos Split_pvm1.json. Tämä pilkkoo alkupäivämäärän osiinsa, mikä helpottaa suodatusta.
- Export to Excel
- Muunna koordinaatit WGS84-asteiksi
	- Kopioi #Muunnos-sarake (linnun TAI havainnoijan paikka) tekstitiedostoon ja tallenna
	- Muunna koordinaatit Luomuksen muunnostyökalulla osoitteessa http://ws.luomus.fi/util/coordinate-mass-conversion
	- Kopioi palautuva teksti tekstitiedostoon
	- Korvaa pilkut tabulaattorilla
- Kopioi data Exceliin
- Poista alkuperäiset koordinaatit ja formaattisarake (sarakkeet B, C ja D)
- Kopioi sarakkeet A, B ja C tekstitiedostoksi. Poista viimeinen tyhjä rivi. 
- Tallenna tekstitiedosto sopivalla nimellä. Nimi saa sisältää kirjaimia, numeroita sekä tavu- ja alaviivoja.
	- Tiedostoon kannattaa lisätä #-merkillä alkava kommenttirivi, johon merkitään muistiin mitä dataa tiedostossa on.

## TODO

* Should: Otsikko
* Should: Havaintojen määrä
* Should: Satelliittikuvapohja
* Should: Kartan otsikko ja sivun title
* Should: Sini-punainen väriskaala
* Should: jätä huomioimatta mahdolliset tyhjät rivit
* Nice: Cap-arvo yksilömäärälle (jonka ylittävät skaalataan yhteen), GET-parametrina?
* Nice: Alueen raja (vektoritaso)
* Nice: Automaattinen keskitys ja zoomaus data-alueelle (ks. satelliittilinnut)
* Nice: Skaalauksen ja datalähteen vaihto Javascriptillä
* Maybe: blur/radius-arvojen säätäminen selainkohtaisesti? Nyt Chrome blurraa vähemmän kuin Firefox ja IE.
