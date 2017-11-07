# Bank

## Зависимости

* PHP 7.1
* Framework Laravel 5.5 
* MySQl 5.5

## Запуск

В проекте присутствует сборка для Vagrant.
Что бы запустить ее нужно иметь на локальной машине
* VirtualBox
* Vagrant
* NFS (Для Windows 10 установка NFS не требуется, а на более ранних оно не работает в принципе)

### Процесс запуска на Vagrant

* скопировать файл локальных конфигов

```
cp /vagrant/config/vagrant-local.example.yml /vagrant/config/vagrant-local.yml

```
* войти в папку /vagrant из под консоли и выполнить команду
```
vagrant up
```
* в локальный файл hosts внести запись
```
192.168.33.10   bank.local
```

### Если запускать вручную

Нужно выполнить следующие действия
* Скопировать конфиги окружения
```
cp .env.example .env
```
* Сгенерировать ключ приложения
```
php artisan key:generate
```
* Добавить в Cron задачу
```
* * * * * php /var/www/artisan schedule:run >> /dev/null 2>&1
```

* Установить пакеты
```
composer install
composer dump-autoload
```

* Создать и заполнить базу
```
php artisan migrate
php artisan db:seed
```
* Расчитать комиссию и проценты по депозитам
```
php artisan deposit-calculate:commission
php artisan deposit-calculate:interest
```

### Ключевые классы

* Расписание Cron настроено здесь 
```
app/Console/Kernel
```

* Логика расчета процентов и комиссии
```
app/Services/DepositManager
```

* Воборка депозитов для расчетов
```
app/Console/Commands/{
    CommissionCommand,
    InterestCommand
}
```

* Статистика
```
app/Http/Controllers/StatisticsController
```