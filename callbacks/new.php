<?

if (is_postback())
{
  
  $path = USER_MODULES_FPATH."/${params['name']}";
  if (file_exists($path))
  {
    flash("Module name aready taken.");
    return;
  }
  $src = $this_module_fpath."/module_template";
  $dst = $path;
  $cmd = "cp -R \"$src\" \"$dst\" 2>&1";
  click_exec($cmd);
  replace_in_file($dst."/views/view.haml", array('#name#'=>$params['name']));
  click_exec("chmod -R 770 \"$dst\"");
  flash_next("Module created. You can find it in $dst");
  redirect_to("/new_module");
}
