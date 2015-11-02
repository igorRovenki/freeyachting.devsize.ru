set :domain,      "fy.devsize.ru"
set :deploy_to,   "/var/www/freeyachting.devsize.ru"
set :user,        "deploy"

role :web,        domain
role :app,        domain, :primary => true
role :db,         domain, :primary => true