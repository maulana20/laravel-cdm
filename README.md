# laravel-cdm
Sistem management document dengan text editor

## Getting Started

### Instalasi

1.  `$ git clone https://github.com/maulana20/laravel-cdm`
2.  `$ composer install`
3.  Buat **.env** dari file **.env.example**
4.  `$ php artisan key:generate`
5.  `$ php artisan storage:link`
6.  `$ php artisan migrate`
7.  `$ php artisan serve`

### Fitur

Fitur pada Aplikasi ini meliputi:

1. Document
    - Dapat mengubah dokument template sesuai variabel
2. Paper
    - Dapat mengkonversi dokument yang di upload **docx** menjadi pdf dan image

### Note
- ubah path libreoffice pada **.env** `CDMSUPPORT_LIBREOFFICE="C:/Program Files/LibreOffice/program/soffice"`
- kemudian refresh config
```bash
$ php artisan config:cache
$ php artisan cache:clear
```

### Requirement
- [LibreOffice](https://www.libreoffice.org/download/download/)
- [Imagick](https://ziixon93.blogspot.com/2020/07/cara-memasang-imagemagick-di-xampp.html)
