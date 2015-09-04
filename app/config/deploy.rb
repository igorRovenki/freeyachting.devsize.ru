set :stage_dir, 'app/config/deploy'
require 'capistrano/ext/multistage'

set :stages, %w(staging)
set :default_stage, "staging"

logger.level = Logger::MAX_LEVEL

set :application, "freeyachting.devsize.ru"

set :scm,         :git
set :repository,  "git@github.com:igorRovenki/freeyachting.devsize.ru.git"
set :branch,      "master"
set :deploy_via,  :remote_cache

ssh_options[:forward_agent] = true
default_run_options[:pty] = true

set :use_composer,   true
set :update_vendors, false
set :dump_assetic_assets, true

set :writable_dirs,     ["app/cache", "app/logs"]
set :webserver_user,    "www-data"
set :use_set_permissions, true
set :shared_files,    [app_path + "/config/parameters.yml"]
set :shared_children, [app_path + "/logs", web_path + "/uploads", "vendor"]
set :composer_options,  "--no-dev --verbose --prefer-dist --optimize-autoloader --no-progress"

before "deploy:restart", "deploy:migrate"
set :model_manager, "doctrine"
set :interactive_mode, false
set :symfony_env_prod, "prod"

set :use_sudo,    false
set :keep_releases, 3
