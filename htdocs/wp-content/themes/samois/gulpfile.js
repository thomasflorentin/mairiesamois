

// les dépendances du fichier gulp
const { src, dest , series , watch } = require("gulp");
const sass = require("gulp-sass");
const rename = require("gulp-rename");
const del = require('del');
const autoprefixer = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');

sass.compiler = require("node-sass");



// VARIABLES
var app_folder = '';
var public_folder = '';
var theme_folder = '/';
var assets_folder = 'assets/';

var jsfolder = assets_folder + 'js/';
var mainjs = jsfolder + 'scripts.js';
var libjs = jsfolder + 'libs/*.js';
var alljs = [mainjs];

var sassfolder = assets_folder + 'stylesheets/';
var sassfiles = sassfolder + '**/*.scss';
var sassMain = sassfolder + 'style.scss';
var sassWC = sassfolder + 'woocommerce.scss';




// task 1 : supprimer le fichier style.css
function cleanTask(){
    return del("./style.css");
}


// task2 : compiler les fichiers dans le dossier scss => style.css
function sassMainTask(){
    const flags = {outputStyle: 'compact'};
    return src( sassMain )
    .pipe(sourcemaps.init())
    .pipe(sass(flags).on('error', sass.logError))
    .pipe(sourcemaps.write('./maps'))
    .pipe(rename("./style.css"))
    .pipe(dest("./"));
}
// task2.1 : compiler les fichiers dans le dossier scss => style.css
function sassWCTask(){
    const flags = {outputStyle: 'compact'};
    return src( sassWC )
    .pipe(sass(flags).on('error', sass.logError))
    .pipe(rename("./woocommerce.css"))
    .pipe(dest("./"));
}

// task3 : ajouter les vendors prefix sur les règles css pour le fichier style.css
// voir le fichier package.json pour voir les paramètres 
function autoprefixerTask(){
    return src("./style.css")
    .pipe(autoprefixer())
    .pipe(dest("."));
}

// task3.1
const jsBundle = () =>
  src(alljs)
    .pipe(concat('all.js'))
    .pipe(dest(jsfolder));



// task4 : mettre en série les tasks 1, 2 et 3
// pas possible serie() dans une fonction, il FAUT l'associer à une variable 
const run = series( cleanTask , sassMainTask, autoprefixerTask, jsBundle ); 
const runjs = series( jsBundle ); 
const runcss = series( cleanTask , sassMainTask, autoprefixerTask ); 


// task5 : si modification dans le dossier scss , lancer la task4
function watchCSS(){
    watch(sassfiles, runcss);
}
// task6 : si modification dans le dossier JS , lancer la task4
function watchJS(){
    watch(alljs, runjs);
}

function defaultTask() {
    watchCSS();
    watchJS();
}
  


// Ensemble des tâches pouvant être appelée via la commande npx gulp 
module.exports = {
    sassmain : sassMainTask,
    sasswc : sassWCTask,
    jsBundle : jsBundle,
    clean : cleanTask ,
    run : run,
    default : defaultTask,
    watchcss : watchCSS,
    watchjs : watchJS,
    //myFont : Iconfont,
  }
