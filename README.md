# web
Web objects and widgets for Plinct app

write on array or json and outuput in HTML

>## basic element
```
[ 
  "tag" => "element tag", 
  "attributes" => [ "name" => "value" ], 
  "content" => "string" or [other element or object: array], 
  "href" => "path/to/" 
]
```

>## picture
> is a object
```
[
  "object" => "picture",
  "attributes" => [
    "class" => "image-styles",
    "id" => "image-id"
  ],
  "src" => "/path/to/image.ext",
  "href" => "/path/to/link",
  "sources" => [
    [ "width" => mumber, "height" => proportional number ],
    [ "width" => 720, "height" => 0.75 ],
    [ "width" => 1024, "height" => 0.5 ]
  ],
  "content" => another object or element
]
```
  
