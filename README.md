# Openlayers Heatmap

Sovellus, joka lukee dataa tekstitiedostosta ja näyttää sen heatmappina ('lämpökarttana') openlayers-karttasovelluksella.

Data tallennetaan tekstitiedostona 'data'-hakemistoon. Tekstitiedoston nimi annetaan sovellukselle GET-parametrina 's'. Data on tiedostossa kolmessa sarakkeessa: lukumäärä, latitude, longitude. Koordinaattien tulee olla wgs84-muodossa desimaaliasteina, desimaalierottimena piste.

Esim.
	http://EXAMPLE.COM/openlayers-heatmap/?s=lancol_lintu_kesa_2000-2014

## TODO

* tietoturva: datatiedoston nimessä ei muuta kuin kirjaimia, numeroita, tavuviivoja ja alaviivoja
* lukumäärien huomioonotto
* kartan otsikko
