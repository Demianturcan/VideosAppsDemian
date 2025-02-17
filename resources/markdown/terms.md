# Visió General del Projecte

Aquest projecte és una aplicació de gestió de vídeos creada amb PHP i Laravel. 
Permet als usuaris veure i interactuar amb contingut de vídeo. 
El projecte inclou diverses funcionalitats com la creació de vídeos, visualització i proves.

### Proves
El projecte inclou proves per comprovar la funcionalitat de l'aplicació.

- **Proves Feature**: Es troben al directori `tests/Feature` i proven l'aplicació des de la perspectiva de l'usuari. 
Per exemple, la classe `VideosTest` prova si els usuaris poden veure vídeos existents i si no poden veure vídeos inexistents.
- **Proves Unit**: Es troben al directori `tests/Unit` i se centren en provar components de l'aplicació. Per exemple, la classe `HelpersTest` prova la funcionalitat de la classe `VideoHelpers`.

### VideoHelpers
La classe `VideoHelpers` conté funcions per gestionar vídeos. 
`createDefaultVideo()`crea un vídeo per defecte amb atributs predefinits.
Aquesta funció s'utilitza tant en proves de Feature com en proves Unit.

### Model de Vídeo
El model es defineix al fitxer `app/Models/Video.php` i s'utilitza a tota l'aplicació per interactuar amb la taula `videos` a la base de dades.

### Vista de Mostra de Vídeo
La vista mostra el títol del vídeo, la descripció i altra informació rellevant.
S'accedeix a través d'una ruta que pren l'ID del vídeo. 
La ruta per a la vista es defineix al fitxer `routes/web.php`, i el mètode del controlador corresponent és responsable de retornar la vista.

### Migracions de Base de Dades
El projecte inclou migracions de base de dades per crear i gestionar les taules 
El fitxer de migració es troba al directori `database/migrations` i defineix l'estructura de la taula `videos`.


## Sprint 3

### Instal·lació del paquet spatie/laravel-permission
S'ha instal·lat el paquet `spatie/laravel-permission`.

### Camp super_admin
S'ha creat una migració per afegir el camp `super_admin` a la taula dels usuaris.

### Model d'usuaris
S'han afegit les funcions `testedBy()` i `isSuperAdmin()` al model d'usuaris.

### Helpers
S'ha afegit el superadmin al professor a la funció `create_default_professor` de `UserHelpers`. També s'han creat les funcions `add_personal_team()`, `create_regular_user()`, `create_video_manager_user()`, `create_superadmin_user()`, `define_gates()` i `create_permissions()`.

### AppServiceProvider
A `app/Providers/AppServiceProvider`, s'han registrat les polítiques d'autorització i s'han definit les portes d'accés a la funció `boot`.

### DatabaseSeeder
S'han afegit els permisos i els usuaris `superadmin`, `regular user` i `video manager` per defecte al `DatabaseSeeder`.

### Publicació dels stubs
S'han publicat els stubs seguint l'exemple de [Laravel News](https://laravel-news.com/customizing-stubs-in-laravel).

### Tests
S'ha creat el test `VideosManageControllerTest` a la carpeta `tests/Feature/Videos` amb les funcions `user_with_permissions_can_manage_videos()`, `regular_users_cannot_manage_videos()`, `guest_users_cannot_manage_videos()`, `superadmins_can_manage_videos()`, `loginAsVideoManager()`, `loginAsSuperAdmin()` i `loginAsRegularUser()`.

S'ha creat el test `UserTest` a la carpeta `tests/Unit` amb la funció `isSuperAdmin()`.
