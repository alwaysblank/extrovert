# Extrovert

Quickly generate simple social media share URLs.

[![Build Status](https://travis-ci.org/alwaysblank/extrovert.svg?branch=master)](https://travis-ci.org/alwaysblank/extrovert)

## Usage

This project only generates URLs (and, optionally, link elements to wrap them); it does *not* implement any kind of more involved sharing activity. It is intended for low-investment implementations.

### URL

To use it, simply call the `url()` static method on the network you want, passing in any relevant arguments. For instance, to generate a link to share something on Facebook, you would do this:

```php
AlwaysBlank\Extrovert\Network\Facebook::url('https://www.alwaysblank.org');
```

Some networks also support additional information, such as a name or description. You can pass these serially, or as part of an array. The following are all equivalent:

```php
AlwaysBlank\Extrovert\Network\Twitter::url('https://www.alwaysblank.org', "Extrovert Can Help", "A new tool to generate simple share URLs.");

AlwaysBlank\Extrovert\Network\Twitter::url([
  'https://www.alwaysblank.org', 
  "Extrovert Can Help", 
  "A new tool to generate simple share URLs."
]);

AlwaysBlank\Extrovert\Network\Twitter::url([
  'uri' => 'https://www.alwaysblank.org', 
  'name' => "Extrovert Can Help", 
  'description' => "A new tool to generate simple share URLs."
]);
```

All content is automatically URL-encoded—do **not** pass in already encoded strings.

### Link

You can also generate a simple link element, with a few [safety features](https://www.jitbit.com/alexblog/256-targetblank---the-most-underestimated-vulnerability-ever/). The syntax is very similar to `url()`, but with `link()` you *must* pass your url arguments as an array.

```php
AlwaysBlank\Extrovert\Network\Twitter::link(
  ['https://www.alwaysblank.org', "Extrovert Can Help", "A new tool to generate simple share URLs."],
  'Share on Twitter',
  ['class' => 'twitter-link']
);
```

## Supported Networks

- Facebook - Supports only the `url` argument.

## Notes

Extrovert is very type-sensitive, so make sure you pass it arguments that it will like: Otherwise it will very rudely start throwing exceptions.

If you pass arguments that are the correct type but are otherwise incorrect, it will very politely just return an empty string. 