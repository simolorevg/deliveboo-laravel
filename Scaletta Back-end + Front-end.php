
<?php

//! INIZIARE PROGETTO LARAVEL 9

/**
 * ! Scaffolding with auth:

 *? 1 composer create-project --prefer-dist laravel/laravel:^9.2 "titolo-progetto"

 *? 1.A composer require laravel/breeze --dev  scarica il pacchetto breeze per autenticazione aggiungendo rotte e views

 *? 1.B  php artisan breeze:install
  
 *? 2 composer require pacificdev/laravel_9_preset
  
 *? 3 php artisan preset:ui bootstrap --auth installa bootstrap e autenticazione e aggiunge rotte e views
  
 *? 4 npm i & npm install @fortawesome/fontawesome-free 
  
 *? 5 npm run dev "in un terminale"
  
 *? 6 php artisan serve  "in un altro terminale" o php -S localhost:8000 -t public
 
 *?6.B php artisan migrate

 *? 6C settare file env e creare database
 
 ** SE SI LAVORA IN GRUPPO, SI CLONA LA REPO
 
 *? 7 composer install

 *? 8 npm i
 
 *? 9 cp .env.example .env
 
 *? 10 php artisan key:generate
 
 *? 11 creare un nuovo database con phpMyAdmin
 
 *? 12 php artisan migrate:rollback 
 
 *? 13 php artisan migrate
 
 *? 14 php artisan db:seed --class=HousesTableSeeder
 
 *? 15 runnare i server (php -S localhost:8000 -t public) 
 
 *?  php artisan storage:link

 */




//! CREARE MODEL E CONTROLLORI ADMIN E GUEST + DASHBOARD
/**
 
 *? php artisan make:model Project -msc --resource

 *? php artisan make:model "Nome singolare" + protected $fillable = ['title', 'description', 'type'];

 *? php artisan make:controller Admin/DashboardController 

 *? php artisan make:controller --resource Admin/NomeController

 *? php artisan make:controller Guest/NomeController 

 *? Creare cartella admin in views con dentro dashboard.blade.php 

 *? e un file in layouts chiamato admin.blade.php

 *? e nelle rotte web.php impostare rotta per dashboard
 *? Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
 *?     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
 *? });

 *? nelle routeserviceprovider.php
 *? si va a cambiare la rotta del login e del logout
 *? public const HOME = '/admin';  sempre uguale al prefix('admin') della rotta sopra            

 */

// ** CONTROLLORE ADMIN ABBIAMO 7 METODI DA POPOLARE CON LE RISPETTIVE ROTTE
// ** php artisan route:list     mostra tutte le rotte del controller resource
//
//   ? public function index()     questo metodo serve per mostrare tutti gli elementi
//   *? {
//   *?     $comics = Comic::all();
//   *?     return view('comic.index', compact('comics'));
//   *? }
//
//    
//   *?  public function create()       questo metodo serve per creare un nuovo elemento
//   *? {
//   *?     return view('comic.create');
//   *? }
//
//    ? public function store(Request $request) //salvare un elemento in db. Request è un oggetto che contiene i dati della form
//    *? {
//    *?    $data = $request->all();
//        $comic = new Comic();
//        $comic->title = $data['title'];
//        $comic->description = $data['description'];
//        $comic->thumb = $data['thumb'];
//        $comic->price = $data['price'];
//        $comic->series = $data['series'];
//        $comic->sale_date = $data['sale_date'];
//        $comic->type = $data['type'];
//       
//         oppure usando il fillable ma ricordando di popolarlo nel MODEL
//    *?     $comic = new Comic();
//    *?     $comic->fill($data);  
//    *?     $comic->save();
//    *?     return redirect()->route('comic.index');
//    *? }
//
//  *?  public function show($id) 
//  *?  {
//  *?      $comic = Comic::findOrFail($id); 
//  *?      return view('comic.show', compact('comic'));
//  *?  }
//
//  *?   public function edit($id)          
//  *?  {
//  *?      $comic = Comic::findOrFail($id);      d
//  *?      return view('comic.edit', compact('comic')); 
//  *?  }
//
//  *?  public function update(Request $request, $id) 
//  *?  {
//  *?      $data = $request->all();          
//  *?      $comic = Comic::findOrFail($id); 
//  *?      $comic->update($data);            
//  *?      return redirect()->route('comic.show', $comic->id);
//  *?  }
//
//  *?  public function destroy($id)    
//  *?  {
//  *?      $comic = Comic::findOrFail($id);
//  *?      $comic->delete();          
//  *?      return redirect()->route('comic.index');
//  *?  }
//
// */
//
//  //* PER USARE POI LE VALIDAZIONI SIA IN FASE DI EDIT E SIA IN FASE DI STORE SI CREANO QUINDI 2 REQUEST COSI:
//
///**
//  *!  php artisan make:request StoreComicRequest
//  *!  php artisan make:request UpdateComicRequest
// *
// 
// **  quindi modifichiamo i 2 metodi store e update cosi:
//
// *?   public function store(StoreComicRequest $request) 
// *?   {
// *?       // $data = $request->all();
// *?       $data=$request->validated();
// *?       //.....
// *?   }
//
// *?   public function update(UpdateComicRequest $request, $id)   
// *?   {
// *?       // $data = $request->all();         
// *?       $data=$request->validated();
// *?       //...
// *?   }
//
//*/

//! NELLE ROUTES WEB :

/**
 *? Route::get('/', [HomeController::class, 'index'])->name('home');

 *?  Route::resource('comic', ComicController::class);              
 **   serve per creare tutte le rotte per il CRUD

 */

//! COMAND LINE PER DB + CREAZIONE TABELLE + ADD COLONNE + ROLLBACK/REFRESH + CREAZIONE SEEDER + POPOLAZIONE TABELLE + UPDATE TABELLE CON FAKER-SEEDER

/**
 *?  1)  php artisan make:migration create_trains_table      crea la tabella creando le colonne dando nome e tipo dato

 *?  
 *?                  public function up() {
 *?                  Schema::table('house', function (Blueprint $table) {
 *?                       $table->id();
 *?                       $table->string('reference', 12);
 *?                       $table->string('address', 100);
 *?                       $table->string('city', 50);
 *?                       $table->string('state', 50);
 *?                       $table->string('zip_code', 10);
 *?                       $table->smallInteger('square_meters')->unsigned();
 *?                       $table->text('description')->nullable();
 *?                       $table->tinyInteger('rooms_number')->unsigned();
 *?                       $table->decimal('price', 10, 2);
 *?                       $table->boolean('is_available')->default(true);
 *?                       $table->timestamps();
 *?                  });
 *?                  
 *?                  
 *?                  
 *?                   public function down() {
 *?                   Schema::dropIfExists('houses');
 *?                     }


 *?  2)  php artisan migrate                                          la carica nel database
 *?  3)  php artisan make:seeder TrainTableSeeder                     crea il seeder che popoliamo o con faker o con i dati che abbiamo in config/nomefil.php

 **    CREAZIONE CON FILE NEL CONFIG
 *?     {*      
 *?         public function run()
 *?         {
 *?             $comic_array=config('comics');
 *?     
 *?             foreach ($comic_array as $comic_item){
 *?                 $comic= new Comic();
 *?                 $comic->title = $comic_item['title'];
 *?                 $comic->description = $comic_item['description'];
 *?                 $comic->thumb = $comic_item['thumb'];
 *?                 $comic->price = $comic_item['price'];
 *?                 $comic->series = $comic_item['series'];
 *?                 $comic->sale_date = $comic_item['sale_date'];
 *?                 $comic->type = $comic_item['type'];
 *?                 $comic->save();
 *?             }
 *?         }

 **     CREAZIONE CON FAKER
 *?         {
 *?             for ($i = 0; $i < 30; $i++) {
 *?                 $comic = new Comic();
 *?                 //popolo i campi
 *?                 $comic->title = $faker->sentence();
 *?                 $comic->description = $faker->paragraph();
 *?                 $comic->thumb = $faker->imageUrl(200, 300);
 *?                 $comic->price = $faker->randomFloat(2, 1, 100);
 *?                 $comic->series = $faker->word();
 *?                 $comic->sale_date = $faker->date();
 *?                 $comic->type = $faker->randomElement(['comic', 'graphic novel']);
 *?                 $comic->save();
 *?             }
 *?         }
 *?     }

 *?  4)  php artisan db:seed --class=TrainTableSeeder                     popolare i dati manipolandoli con i faker nella tabella del database
 *?  5)  php artisan migrate:refresh(1 batch) (fresh tutti i batch)       cancella tutto e ricrea tutto da capo ma senza i dati, da non fare mai in produzione
 *?  7)  php artisan make:migration add_price_to_trains_table             aggiunge la colonna alla tabella
 *?  8)  php artisan migrate                                              la carica nel database    
 *?  9)  se si usano faker popolare questa colonna con faker aggiungendo una tupla
 *?  9)  php artisan db:seed --class=Train_Table_Seeder                     ri popolare la nuova colonna      
 *?  10)  php artisan migrate:rollback                                     se serve...cancella l'ultima migrazione

 */

// *-------------------------------------------------------------------------

/**
 * ! COMANDI RAPIDI
 * 
 * 1)  php artisan make:migration create_trains_table 
 * 2)  php artisan migrate 
 * 3)  php artisan make:seeder TrainTableSeeder 
 * 4)  php artisan db:seed --class=TrainTableSeeder
 * 5)  php artisan migrate:refresh
 * 6)  php artisan make:migration add_price_to_trains_table 
 * 7)  php artisan migrate  
 */






?>
 <?php 

//!                                   PER LE RELAZIONI ONE TO MANY
//?  
//?     FARE LO SCHEMA ER per dare una visione d'insieme
//?    - Tabella principale è project_table
//? 
//?    - Creare la migration della  tabella secondaria:  php artisan make:migration create_types_table
//? 
//?    - Create la migration per la FK nella tabella con asterisco, aggiungendo la FK della tabella con 
//?     numero 1 di relazione con php artisan make:migration add_foreign_project_to_type_table, poi nei metodi UP   e         DOWN:
//? 
//?          UP:aggiungo la colonna e aggiungo foreign 
 
                     
                    public function up()
                        {
                                 Schema::table('projects', function (Blueprint $table) {
                                    $table->unsignedBigInteger('type_id')->nullable()->after('id'); 
                                    $table->foreign('type_id')->references('id')->on('types')->onDelete('set null'); 
                                   });
                        }

//?           DOWN: tolgo foreign, tolgo la colonna

                        public function down()
                        {
                            Schema::table('projects', function (Blueprint $table) {
                                $table->dropForeign('projects_type_id_foreign'); 
                                $table->dropcolumn('type_id');                

                            });
                        }
                        
//?               php artisan migrate          

//? - Creare Model della nuova tabella (Type) :   php artisan make:model Type   

//? - Opzionale: Creare seeder per la nuova tabella (CategorySeeder) : php artisan make:seeder TypeSeeder
//?                                popolare la tabella con :           php artisan db:seed --class=TypeSeeder

                        public function run() 
                        {
                            $types = ['Web', 'Mobile', 'Desktop', 'Game'];
                            foreach($types as $type_value){
                                $new_type= new Type();
                                $new_type->name = $type_value;
                                $new_type->slug = Str::slug($type_value, '-');
                                $new_type->save();
                            }
                            
                        }

//? - Collegare i model: 
 
//?         -> Nel model della tabella principale belongsTo aggiungendo anche il nome della colonna FK

                        class Project extends Model
                        {
                            use HasFactory;
                            protected $fillable = ['title', 'slug', 'content', 'type_id'];
                            public function types() {
                                return $this->belongsTo(Type::class);
                            }
                        }

//?    -> Nel model della tabella secondaria hasMany

                        class Type extends Model
                        {
                            use HasFactory;
                            public function projects(){
                                return $this->hasMany(Project::class);
                            }
                        }



//? - Aggiungiamo nelle CRUD i collegamenti alla nuova tabella e modifichiamo anche i file Request

//?       -> nel INDEX e SHOW: visualizziamo il valore ($project->type?->name)

                        public function index()
                        {
                            $projects = Project::all();
                            $count = Project::count();
                            return view('admin.projects.index', compact('projects', 'count'));
                        }

                        public function show(Project $project)
                        {
                            return view('admin.projects.show', compact('project'));
                        }

//?      -> nel CREATE, EDIT: preleviamo tutte le category e li passiamo alla view -> tramite foreach generiamo le otions del select

                        public function create()
                        {
                            $types = Type::all();
                            return view('admin.projects.create', compact('types'));
                        }
                        public function edit(Project $project)
                        {
                            $types = Type::all();
                            return view('admin.projects.edit', compact('project', 'types'));
                        }

//?      -> nel STORE, UPDATE: nel Request aggiungiamo le regole di validazione per il nuovo dato (type_id)


                        public function store(StoreProjectRequest $request)
                        {
                            $data=$request->validated();
                            $data['slug'] = Str::slug($data['title'], '-');
                            $project = Project::create($data);
                            return redirect()->route('admin.projects.index')->with('message', 'Il progetto ' . $project->title . ' è stato creato con successo');
                        }
                        public function update(UpdateProjectReqeust $request, Project $project)
                        {
                            $data = $request->validated();
                            $data['slug'] = Str::slug($data['title'], '-'); 
                            $project->update($data); 
                            return redirect()->route('admin.projects.index', $project->slug)->with('message', 'Il progetto ' . $project->title . ' è stato modificato con successo');
                        }

//* --------------------------------------------------------------------------------------------------------------------------------------------

                        public function rules()
                        {
                            return [
                                'title' => ['required','min:3','max:150', Rule::unique('projects')->ignore($this->project)], 
                                'content' => 'nullable|string',
                                'type_id'=> ['nullable', 'exists:types,id']
                            ];
                        }
                        

                        public function messages()
                        {
                            return [
                                'title.required' => 'Il titolo è richiesto e deve essere lungo almeno 3 caratteri',
                                'title.min' => 'Il titolo deve essere lungo almeno :min caratteri',
                                'title.max' => 'Il titolo non deve superare :max caratteri',
                                'title.unique' => 'Il titolo inserito è già stato utilizzato',
                                'type_id' => 'Il tipo di progetto deve essere presente nel database'
                            ];
                        }



//!                      MANY TO MANY


//?    creare terza tabella--------php artisan make:migration create_tags_table e modificare metodo UP con es: name e slug->unique

//?    creare tabella ponte inserendo i nomi delle 2 tabelle in ordine alfabetico (es: Post_Tag)con post_id e tag_id

//?    php artisan make:migration create_post_tag_table con

                    public function up(){
                     Schema::create('post_tag', function (Blueprint $table) {
                         $table->unsignedBigInteger('post_id');
                         $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
                         $table->unsignedBigInteger('tag_id');
                         $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');  

                         $table->primary(['post_id', 'tag_id']);            //chiave primaria composta dalle 2 FK
                     });
                    }

//?      php artisan migrate

//? creare model  php artisan make:model Tag  mentre per la tabella ponte non serve

//? nei 2 model aggiungere i collegamenti con belongsToMany in entrambi i model

                    class Tag extends Model
                    {
                        use HasFactory;
                        public function posts() {
                            return $this->belongsToMany(Post::class);
                        }
                    }


                    class Post extends Model
                    {
                        use HasFactory;
                        protected $fillable = ['title', 'slug', 'content', 'category_id'];
                        
                        public function tags() {
                            return $this->belongsToMany(Tag::class);
                        }
                        // public function category() {
                        //     return $this->belongsTo(Category::class);
                        // }
                    }

//? creare seeder per la nuova tabella (TagSeeder) : php artisan make:seeder TagSeeder

                    public function run()
                    {
                        $tags = ['vegano', 'gluten-free', 'dolce', 'salato', 'piccante', 'vegetariano'];
                        foreach($tags as $tag_value){
                            $new_tag= new Tag();
                            $new_tag->name = $tag_value;
                            $new_tag->slug = Str::slug($tag_value, '-');
                            $new_tag->save();
                        }
                    }

//? popolare la tabella con :           php artisan db:seed --class=TagSeeder
//? per vederli in pagina, tags plurale perche nel model abbiamo usato il plurale per la funzione
    
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name }} {{ $loop->last ? '' : ',' }}</span>
                        @endforeach
//? per rendere i tag link cliccabili aggiungiamo il link per vedere tutti i post con quel tag
//? devo creare CRUD per i tag e aggiungere la rotta nel web.php

                        @foreach ($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}"><span class="badge badge-primary">{{ $tag->name }} {{ $loop->last ? '' : ',' }}</span></a>
                        @endforeach

                        
//!                                      PAGINATION


//se volessi far vedere i projects impaginandoli 10 per pagina, dovrei modificare il metodo index del controller

                        public function index()
                        {
                            $projects = Project::paginate(10);
                            return view('admin.projects.index', compact('projects'));
                        }

//Mentre una cosa del genere se volessi anche applicare dei filtri di ricerca

                  

                        if ($request->has('category_id') && !is_null($data['category_id'])) {
                            $posts = Post::where('category_id', $data['category_id'])->paginate(10);
                        } else {
                            $posts = Post::paginate(10);
                        }
                



//in provider/AppService provider aggiungere la funzione boot

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

                        Paginator::useBootstrapFive();                  
                        
                        
//e nell index.blade aggiungere un div cosi:

                    <div>
                    {{ $posts->links() }}
                    </div>

//!                         FILE STORAGE

//impostare il filesystem disk di default a "public" nel file config/filesystem.php
//nel file .env la chiave FILESYSTEM_DISK impostiamo il valore public

// se non c'è, aggiungere una colonna image nella tabella project 

            php artisan make:migration add_image_to_projects_table --table=projects


            public function up() {
                Schema::table('posts', function (Blueprint $table) {
                    $table->string('image')->nullable()->after('slug');
                });
            }
        
            public function down() {
                Schema::table('posts', function (Blueprint $table) {
                    $table->dropColumn('image');
                });
            }


// e fare migrazione con 
                         php artisan migrate

//creare il symlink per la cartella storage:
                 php artisan storage:link

//Per poter caricare un file, dobbiamo aggiungere l’attributo enctype al form
         enctype="multipart/form-data"

//Nel nostro controller usiamo la funzione store() per salvare il file nella cartella storage/app/public e per salvare il path nel database cosi:


           $img_path = Storage::put('posts_covers', $data['image']);

  
//Per salvare l'immagine in un disco diverso da quello di default usiamo il metodo Storage::disk('nome') cosi:

              $img_path = Storage::disk('public')->put('posts_covers', $data['image']);

//Per visualizzare file caricato utilizzare la  funzione asset() cosi:

     <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">




//!     LAVORARE CON API

//nella repo appena creata, creare un controller per la rotta api cosi:

        php artisan make:controller Api/ProjectController

        // aggiungere use e creare il metodo index cosi:


use App\Models\Project;


        public function index()
        {
            $projects = Project::all();
            return response()->json([
                'success' => true,
                'results' => $projects
            ]);
        }

        //poi creare la rotta api nel web.php cosi:
        use App\Http\Controllers\Api\ProjectController;

        Route::get('projects', [ProjectController::class, 'index']);

        //testare con postman l'effettivo funzionamento cosi:
        http://localhost:8000/api/projects




        
//!            CREARE PROGETTO FRONT END VITE CON 

npm create vite@latest nome-repo -- --template vue

// fare tutte le installazioni delel dipendenze: axios,bootstrap cosi:

npm install axios bootstrap 

npm install --save @fortawesome/fontawesome-free    nel terminale

@import "node_modules/@fortawesome/fontawesome-free/css/all.css"; VA IMPORTATO IN GENERAL.scss





//!                     ROUTING FRONT END

// lanciare comando per creare il file routes.js dentro la cartella src cosi:


npm install vue-router@4


// dentro src creiamo cartella pages con 2 pagine interne, homepage.vue e PostLists.vue e le importiamo dentro postlits inseriamo tutto cio che c erain app.vue

// src/pages/HomePage.vue & ProjectPage.vue e ProjectPage.vue farà cio che faceva prima App.vue

// all interno di app.vue rimane uno scheletro  aggiungere il tag router-view  dentro il template:

<template>
        <Header/>
        <router-view></router-view> //gestirà il contenuto delle pagine come uno yeld
</template>

//impostiamo il router cosi dentro il file router.js creato dentro src:

// dobbiamo far si che app.vue sia un layout condiviso da tutte le pagine, quindi dobbiamo creare un file router.js che definisce le rotte cosi:

import { createRouter, createWebHistory } from 'vue-router';
import Homepage from './pages/Homepage.vue';
import PostLists from './pages/PostLists.vue';

const router = createRouter({
    history: createWebHistory(), //history è il tipo di router che vogliamo usare, createWebHistory è quello che usa le history API del browser
    routes: [
        {
            path: '/',
            name: 'home',
            component: Homepage
        },
        {
            path: '/posts',
            name: 'posts',
            component: PostLists
        }
    ]
});

export  {router};


// im main.js importiamo il router cosi:

import { createApp } from 'vue';
import App from './App.vue';
import { router } from './router';

createApp(App).use(router).mount('#app');




// al posto di ancor tag si usano i router-link e al posto di href si usa to: in sostanza cosi 

<router-link to="/">Home</router-link>
<router-link to="/posts">Posts</router-link>


 //oppure object notation 

//<router-link :to="{ name: 'home' }">Home</router-link>
// <router-link :to="{ name: 'posts' }">Posts</router-link>

con questi router link una navbar diventa cosi:

// <nav>

    // <router-link :to="{ name: 'home' }">Home</router-link>
    // <router-link :to="{ name: 'posts' }">Posts</router-link>
    // </nav>

    in data(){
        return{
            menuItem{
                label : 'Home',
                name: 'home'
            },
                {
                    label : 'Posts',
                    name: 'posts'
                }
        }
    },



    data(){
        errorMessages: [],
        notFound: false,
        

//     se c'è una richiesta per cui non c'è una risposta occorre rendere semntico il 404 cosi:

//     nella richiesta axios inseriamo un catch cosi:

    axios.get(http:/./localhost:8000/api/projects)
    .then(
        (response) => {
        this.projects = response.data.results;
    }, (error) => {
        if(error.response.status === 404) {
            this.notFound = true;
        }
    });
    
    


    <template>
        <div>
            <h1>404</h1>
            <p>Page not found</p>
        </div>







//!                         EMAIL

// per inviare email si usa protolllo smtp, per farlo si usa mailtrap.io

        composer require guzzlehttp/guzzle

      //  nel file env inserire le credenziali del nostro mailtrap di mailtrap cosi:

        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=d62614577a9ae7
        MAIL_PASSWORD=4a2e57b3df48b7
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS=federicocet@gmail.com 
        MAIL_FROM_NAME="${APP_NAME}"

       // occorre creare un oggetto mailable cosi:
       //email con avviso del nuovo post creato nel metodo store di admin/Postocontroller 
       
       php artisan make:mail NewPost
        
       creare cartella emails in views e new-post-email.lade.php


         //nel file NewPost.php inserire il metodo build cosi:

         class NewPost extends Mailable{

            public $post;
            public function __costruct($_post){
                $this->post = $_post;
            }

            public function envelope()
            {
                return new Envelope (
                    subject: 'New post created',
                );
            }

            public function content ()
            {
                return $this->markdown('emails.new-post');
            }
        }


//nel metodo STORE del projectController aggiungere

         //email all amminastratore con avviso del nuovo project
         Mail::to('federicocet@gmail.com')->send(new NewProject($project));







// creare una nuova migration:

php artisan make:migration create_leads_table

//  nel metodo up

$table->string('email');
$table->string('name');
$table->text('message')->nullable();

// php artisan migrate

// php artisan make:controller Api/LeadController
// php artisan make:model Lead

// implementare lo store()

public function store(Request $request)
{
    $data = $request->all();

    $validator = Validator::make($data, [
        'email' => 'required|email',
        'name' => 'required|string',
        'message' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
        ], 422);
    }

    $new_lead = Lead::create($data);

    //per inviare email

    Mail::to('federicocet@gmail.com')->send(new NewLead($new_lead));

    return response()->json([
        'result' => 'true',
    ]);
}

//  Aggiungere nelle route/api la rotta:

    Route::post('leads', [LeadController::class, 'store']);

    php artisan make:mail NewLead






// accesso SSH - ssh 'user'@'nome_dominio' , poi inserire password
//              se non sei root lanciare: sudo su
//              imparare apache & nginx, guida come configurare virtual host ( 1 virtual host 1 progetto)


?>
