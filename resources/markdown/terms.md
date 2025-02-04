# Visió General del Projecte

Aquest projecte és una aplicació de gestió de vídeos creada amb PHP i Laravel. 
Permet als usuaris veure i interactuar amb contingut de vídeo. 
El projecte inclou diverses funcionalitats com la creació de vídeos, visualització i proves.

## Proves
El projecte inclou proves per comprovar la funcionalitat de l'aplicació.

- **Proves Feature**: Es troben al directori `tests/Feature` i proven l'aplicació des de la perspectiva de l'usuari. 
Per exemple, la classe `VideosTest` prova si els usuaris poden veure vídeos existents i si no poden veure vídeos inexistents.
- **Proves Unit**: Es troben al directori `tests/Unit` i se centren en provar components de l'aplicació. Per exemple, la classe `HelpersTest` prova la funcionalitat de la classe `VideoHelpers`.

## VideoHelpers
La classe `VideoHelpers` conté funcions per gestionar vídeos. 
`createDefaultVideo()`crea un vídeo per defecte amb atributs predefinits.
Aquesta funció s'utilitza tant en proves de Feature com en proves Unit.

## Model de Vídeo
El model es defineix al fitxer `app/Models/Video.php` i s'utilitza a tota l'aplicació per interactuar amb la taula `videos` a la base de dades.

## Vista de Mostra de Vídeo
La vista mostra el títol del vídeo, la descripció i altra informació rellevant.
S'accedeix a través d'una ruta que pren l'ID del vídeo. 
La ruta per a la vista es defineix al fitxer `routes/web.php`, i el mètode del controlador corresponent és responsable de retornar la vista.

## Migracions de Base de Dades
El projecte inclou migracions de base de dades per crear i gestionar les taules 
El fitxer de migració es troba al directori `database/migrations` i defineix l'estructura de la taula `videos`.
