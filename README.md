# Extrovert

Quickly generate simple social media share URLs.

[![Build Status](https://travis-ci.org/alwaysblank/extrovert.svg?branch=master)](https://travis-ci.org/alwaysblank/extrovert)

## Usage

This project only generates URLs (and, optionally, link elements to wrap them); it does *not* implement any kind of more involved sharing activity, and it never will. It is not attempting to be a social media clearinghouse with deep integration, interactivity, and share counts, so it will only ever support services that allow for sharing through the simple mechanism of a link.

### URL

To use it, simply call the `url()` static method on the network you want, passing in any relevant arguments. For instance, to generate a link to share something on Facebook, you would do this:

```php
AlwaysBlank\Extrovert\Network\Facebook::url('https://www.alwaysblank.org');
```

Some networks also support additional information, such as a name or description. You can pass these serially, or as part of an array. The following are all equivalent:

```php
AlwaysBlank\Extrovert\Network\ExampleNetwork::url('https://www.alwaysblank.org', "Extrovert Can Help", "A new tool to generate simple share URLs.");

AlwaysBlank\Extrovert\Network\ExampleNetwork::url([
  'https://www.alwaysblank.org', 
  "Extrovert Can Help", 
  "A new tool to generate simple share URLs."
]);

AlwaysBlank\Extrovert\Network\ExampleNetwork::url([
  'uri' => 'https://www.alwaysblank.org', 
  'name' => "Extrovert Can Help", 
  'description' => "A new tool to generate simple share URLs."
]);
```

All content is automatically URL-encoded—do **not** pass in already encoded strings.

### Link

You can also generate a simple link element, with a few [safety features](https://www.jitbit.com/alexblog/256-targetblank---the-most-underestimated-vulnerability-ever/). The syntax is very similar to `url()`, but with `link()` you *must* pass your url arguments as an array.

```php
AlwaysBlank\Extrovert\Network\ExampleNetwork::link(
  ['https://www.alwaysblank.org', "Extrovert Can Help", "A new tool to generate simple share URLs."],
  'Share on Network',
  ['class' => 'link']
);
```

## Supported Networks

- Facebook - Supports only the `url` argument.
- LinkedIn - Supports the `url` argument.
- Twitter - Supports the `url` and `name` arguments.
- Pinterest - Supports the `url`, `description`, and `media` arguments, but beat in mind that they *must* be passed as a key array, and that you *must* pass both a `url` and `media` value--Pinterest won't understand it otherwise, and you'll get odd results.
- Email - Supports the `url` and `name`, and `description` arguments, but behaves a little differently. It expects `description` to contain a `%s` that will be replaced with the `url`. It will also attempt to generate reasonable defaults for `name` and `description` (the subject and body of the email respectively) if none are provided.
- Your Favorite! - Submit an [issue](https://github.com/alwaysblank/extrovert/issues/new) or, even better, a [pull request](https://github.com/alwaysblank/extrovert/pulls)! Please do keep in mind the limitations and intentions of the project, however.

## Notes

Extrovert is very type-sensitive, so make sure you pass it arguments that it will like: Otherwise it will very rudely start throwing exceptions.

If you pass arguments that are the correct type but are otherwise incorrect, it will very politely just return an empty string. 

Many of these services will pull information to populate rich links from the URL you are telling them to link to. For this reason, it is wise to make sure that the metadata (and/or OpenGraph data) on that URL is correctly implemented. It also means that they will throw errors if you try to link to unreachable URLS (i.e. `development-site.local`); 
