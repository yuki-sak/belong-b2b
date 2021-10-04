cd `dirname $0`
#!/bin/sh
Files=$(find . -type f -iname '*'.png)
# printf  "$Files\n"
for File in $Files
do
    echo $File  'optimization';
    /opt/homebrew/bin/pngquant --ext .png --force $File
done

#!/bin/sh
Files=$(find . -type f -iname '*'.jpg)
# printf  "$Files\n"
for File in $Files
do
    /opt/homebrew/bin/jpegoptim --strip-all --max=90 $File.jpg $File
done

