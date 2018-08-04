cd ~/blog/
hexo deploy --generate
cd ~/blog/public
rm -rf a.zip
zip a.zip * -r
cd ~/blog
