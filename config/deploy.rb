default_run_options[:pty] = true
if ENV['environment'] == "production"
  set :application, "devonstudioschool"
  role :app, "devonstudioschool.co.uk"
  role :web, "devonstudioschool.co.uk"
  role :db, "devonstudioschool.co.uk", :primary => true
else
  set :application, "dss"
  role :app,  "webdev.southdevon.ac.uk"
  role :web,  "webdev.southdevon.ac.uk"
  role :db,   "webdev.southdevon.ac.uk", :primary => true
end

set :repository,  "git@github.com:briancrocker81/DevonStudioSchool.git"
set :branch,      "dev"
set :deploy_to, "/srv/#{application}"
set :scm, :git

namespace :deploy do
  %W(start stop restart migrate finalize_update).each do |event|
    task event do
      # don't
    end
  end
end

after "deploy:create_symlink" do
  run "cp #{shared_path}/configuration.php #{current_path}/"
  run "cp #{shared_path}/.htaccess #{current_path}/"
  ["images", "media/rokgallery"].each do |d|
    run "rm -rvf #{current_path}/#{d}"
    run "ln -s #{shared_path}/#{d} #{current_path}/#{d}"
  end
  run "chmod a+rw -R #{current_path}"
end
