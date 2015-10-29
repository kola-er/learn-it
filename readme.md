# learn-it

[![Build Status](https://travis-ci.org/andela-kerinoso/learn-it.svg)](https://travis-ci.org/andela-kerinoso/learn-it)

Learn-it is a PHP Learning Management System project that provides a platform for sharing Youtube videos that teach something people could learn.

## Usage

To download and use this project you need to have the following installed on your machine

- Composer
  Visit the [official website](https://getcomposer.org/doc/00-intro.md) for installation instructions.
- Laravel homestead
  Visit [Laravel website](http://laravel.com/docs/5.1/homestead) for installation and setup instructions.

When you have completed the above processes, run:

```bash
$ git clone https://github.com/andela-kerinoso/learn-it
`````
to clone the repository to your working directory. This step presumes that you have git set up and running.

Run

```bash
$ composer install
```
to pull in the project dependencies.

Now you are set up and ready to run.

* Project features
- Username/Email Signup/Login authentication
- Social authentication
- User Profile Management
- Youtube video post - Authenticated users only!
- Browse all videos
- Browse videos by category
- View single video

Visit [learn-it demo page](https://learner-tube.herokuapp.com/) to view the project demo.

## Change log

Please check out [CHANGELOG](CHANGELOG.md) file for information on what has changed recently.

## Testing

``` bash
$ vendor/bin/phpunit test
```

## Contributing

Please check out [CONTRIBUTING](CONTRIBUTING.md) file for detailed contribution guidelines.

## Credits

learn-it is maintained by `Kolawole ERINOSO`.

## License

learn-it is released under the MIT Licence. See the bundled [LICENSE](LICENSE.md) file for details.