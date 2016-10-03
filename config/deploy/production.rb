# server-based syntax
# ======================
# Defines a single server with a list of roles and multiple properties.
# You can define all roles on a single server, or split them:

# server 'example.com', user: 'deploy', roles: %w{app db web}, my_property: :my_value
# server 'example.com', user: 'deploy', roles: %w{app web}, other_property: :other_value
# server 'db.example.com', user: 'deploy', roles: %w{db}
server 'd.rimbault@185.30.92.167:823', roles: %w{app db web}
set :deploy_to, '/var/www/domains/nginx/appli.bovimarket.com/overscan'

set :branch, 'Prod'
SSHKit.config.umask = 002


# role-based syntax
# ==================

# Defines a role with one or multiple servers. The primary server in each
# group is considered to be the first unless any  hosts have the primary
# property set. Specify the username and a domain or IP for the server.
# Don't use `:all`, it's a meta role.

# role :app, %w{deploy@example.com}, my_property: :my_value
# role :web, %w{user1@primary.com user2@additional.com}, other_property: :other_value
# role :db,  %w{deploy@example.com}



# Configuration
# =============
# You can set any configuration variable like in config/deploy.rb
# These variables are then only loaded and set in this stage.
# For available Capistrano configuration variables see the documentation page.
# http://capistranorb.com/documentation/getting-started/configuration/
# Feel free to add new variables to customise your setup.



# Custom SSH Options
# ==================
# You may pass any option but keep in mind that net/ssh understands a
# limited set of options, consult the Net::SSH documentation.
# http://net-ssh.github.io/net-ssh/classes/Net/SSH.html#method-c-start
#
# Global options
# --------------
 set :ssh_options, {
   keys: %w(~/.ssh/d.rimbault),
   forward_agent: true,
   auth_methods: %w(publickey)
 }
#
# The server-based syntax can be used to override options:
# ------------------------------------
# server 'example.com',
#   user: 'user_name',
#   roles: %w{web app},
#   ssh_options: {
#     user: 'user_name', # overrides user setting above
#     keys: %w(/home/user_name/.ssh/id_rsa),
#     forward_agent: false,
#     auth_methods: %w(publickey password)
#     # password: 'please use keys'
#   }

namespace :deploy do
    before :updated, :change_ownership do
        on roles(:web) do
            execute :chgrp, "-R" , fetch(:group), fetch(:release_path)
        end
    end
    namespace :symlink do
        desc "Symlink release to current"
        Rake::Task["release"].clear_actions
        task :release do
          on release_roles :all do
            tmp_current_path = release_path.parent.join(current_path.basename)
            relative_path  = Pathname.new("releases/").join(release_path.basename)
            execute :ln, "-s", relative_path, tmp_current_path
            execute :mv, tmp_current_path, current_path.parent
            #execute :ln, "-s", relative_path, current_path
          end
        end
    end
end

namespace :composer do
  before :run, :change_path do
    on roles(:web) do
      SSHKit.config.command_map[:composer] = "php70 #{release_path.join("composer.phar")}"
    end
  end

end