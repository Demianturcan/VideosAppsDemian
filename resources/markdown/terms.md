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



## Sprint 4

### 1. Creació de `VideosManageController`
S'ha creat el controlador `VideosManageController` amb les funcions necessàries per gestionar els vídeos, incloent la creació, edició, actualització, eliminació i visualització de vídeos.

### 2. Creació de la funció `index` a `VideosController`
S'ha afegit la funció `index` a `VideosController` per mostrar la llista de vídeos.

### 3. Verificació de la creació de vídeos a `VideoHelpers` i `DatabaseSeeder`
S'ha verificat que es creïn 3 vídeos per defecte a `VideoHelpers` i s'han afegit al `DatabaseSeeder`.

### 4. Creació de vistes per a les operacions CRUD
S'han creat les vistes per a les operacions CRUD de vídeos, accessibles només per a usuaris amb els permisos adients:
- `index.blade.php`
- `create.blade.php`
- `edit.blade.php`
- `delete.blade.php`

### 5. Modificació del test `user_with_permissions_can_manage_videos()`
S'ha modificat el test `user_with_permissions_can_manage_videos()` per assegurar que hi hagi 3 vídeos.

### 6. Creació de permisos de vídeos a `UserHelpers`
S'han creat els permisos necessaris per gestionar vídeos a `UserHelpers` i s'han assignat als usuaris corresponents.

### 7. Creació de funcions de test a `VideoTest` i `VideosManageControllerTest`
S'han creat diverses funcions de test per assegurar que els usuaris amb i sense permisos puguin gestionar els vídeos correctament.

### 8. Creació de rutes per a `videos/manage`
S'han creat les rutes per a les operacions CRUD de vídeos amb el middleware corresponent, assegurant que les rutes CRUD només siguin visibles quan l'usuari està logejat.

### 9. Afegir navbar i footer a la plantilla `videosapp`
S'ha afegit una barra de navegació i un peu de pàgina a la plantilla `resources/layouts/videosapp` per facilitar la navegació entre pàgines.




## Sprint 5

### 1. S'ha afegit el camp `user_id` a la taula de vídeos
- Afegit el camp `user_id` a la taula `videos` per guardar l'usuari que ha afegit el vídeo.
- Modificat el `VideoController`, `Video` model i `VideoHelpers` per suportar aquest canvi.

### 2. S'han arreglat tests fallits
- Corregit els tests fallits dels sprints anteriors després de modificar el codi.

### 3. S'ha creat `UsersManageController`
- Creat el `UsersManageController` amb les funcions `testedby`, `index`, `store`, `edit`, `update`, `delete` i `destroy`.

### 4. S'han creat funcions `index` i `show` a `UsersController`
- Afegit les funcions `index` i `show` a `UsersController`.

### 5. S'han creat vistes per al CRUD d'usuaris
- Creat les vistes per al CRUD d'usuaris accessibles només per a usuaris amb permisos adients:
    - `resources/views/users/manage/index.blade.php`
    - `resources/views/users/manage/create.blade.php`
    - `resources/views/users/manage/edit.blade.php`
    - `resources/views/users/manage/delete.blade.php`

### 6. S'ha afegit taula del CRUD d'usuaris a `index.blade.php`
- Afegit la taula del CRUD d'usuaris a la vista `index.blade.php`.

### 7. S'ha afegit formulari per afegir usuaris a `create.blade.php`
- Afegit el formulari per afegir usuaris a `create.blade.php` utilitzant l'atribut `data-qa` per facilitar els tests.

### 8. S'ha afegit taula del CRUD d'usuaris a `edit.blade.php`
- Afegit la taula del CRUD d'usuaris a `edit.blade.php`.

### 9. S'ha afegit confirmació d'eliminació d'usuari a `delete.blade.php`
- Afegit la confirmació d'eliminació d'usuari a `delete.blade.php`.

### 10. S'ha creat vista `resources/views/users/index.blade.php`
- Creat la vista `resources/views/users/index.blade.php` per veure tots els usuaris, buscar-los i accedir al detall de l'usuari i els seus vídeos.

### 11. S'han creat permisos de gestió d'usuaris a `UserHelpers`
- Creat els permisos de gestió d'usuaris per al CRUD i s'han assignat als usuaris `superadmin`.

### 12. S'han creat funcions de test a `UserTest`
- Creat les funcions de test a `UserTest`:

### 13. S'han creat funcions de test a `UsersManageControllerTest`
- Creat les funcions de test a `UsersManageControllerTest`:

### 14. S'han creat rutes per al CRUD d'usuaris
- Creat les rutes per al CRUD d'usuaris amb el middleware corresponent i les rutes `index` i `show` d'usuaris. Les rutes només són visibles quan l'usuari està logejat.

### 15. S'ha assegurat la navegació entre pàgines
- Assegurat que es pugui navegar entre pàgines.
- SModificat la visibilitat dels botons de navegació segons l'autentificació.

### 16. S'han comprovat els fitxers creats amb Larastan
- Comprovat tots els fitxers creats amb Larastan per assegurar la qualitat del codi.



## Sprint 6

### 1. Modificació de vídeos per assignar-los a sèries
- S'ha afegit l'opció de relacionar un vídeo amb una sèrie quan es crea i edita.

### 2. Permisos de creació de vídeos per a usuaris regulars
- S'han afegit les funcions del CRUD per a usuaris regulars a `VideoController`.
- S'han creat els botons per al CRUD a la vista de vídeos.
- S'han afegit funcions i rutes per a la gestió per part de l'usuari a `VideoController`, aprofitant algunes operacions existents a `VideoManageController`.
- A la pàgina `show` de vídeos es mostren dos botons per modificar-los, visibles només per al propietari.

### 3. Creació de la migració de sèries
- S'ha creat la migració per a la taula de sèries amb els camps `id`, `title`, `description`, `image`, `user_name`, `user_photo_url`, `published_at`.

### 4. Creació del model de sèries
- S'han creat les funcions `testedby`, `videos` (relació 1:N), `getFormattedCreatedAtAttribute`, `getFormattedForHumansCreatedAtAttribute`, `getCreatedAtTimestampAttribute`.

### 5. Relació 1:N al model de vídeos
- S'ha afegit la relació 1:N al model de vídeos amb sèries.

### 6. Creació de `SeriesManageController` i `SeriesController`
- S'ha creat el controlador `SeriesManageController` amb les funcions `testedby`, `index`, `store`, `edit`, `update`, `delete` i `destroy`.
- S'ha creat el controlador `SeriesController` amb les funcions `index` i `show`.

### 7. Helpers per al seed de sèries
- S'han creat els helpers per al seed amb 3 sèries.

### 8. Vistes per al CRUD de sèries
- S'han creat les vistes per al CRUD, disponibles per als usuaris amb permisos adients: `resources/views/series/manage/index.blade.php`, `resources/views/series/manage/create.blade.php`, `resources/views/series/manage/edit.blade.php`, `resources/views/series/manage/delete.blade.php`.

### 9. Confirmació d'eliminació de sèries
- A la vista `delete.blade.php`, s'ha afegit la confirmació per eliminar sèries amb l'opció de desassignar o eliminar els vídeos relacionats.

### 10. Vistes `index` i `show` de sèries
- S'ha afegit la vista `index` de sèries i el `show` corresponent per mostrar els vídeos relacionats: `resources/views/series/index.blade.php`.

### 11. Permisos de gestió de sèries
- S'han creat helpers per assignar els permisos adients per a sèries.

### 12. Tests de permisos a `SeriesManageControllerTest`
- S'han creat els tests de permisos adients per a les sèries a `SeriesManageControllerTest`:

### 13. Rutes per al CRUD de sèries
- S'han creat les rutes de `series/manage` per al CRUD de les sèries amb el seu middleware corresponent i la ruta de l'índex i el `show` de sèries.
