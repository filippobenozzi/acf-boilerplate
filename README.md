# ACF Boilerplate

**NB.** This project require an ACF PRO license key, *Node 18*, bun package manager.

### Installation

1. Download the repository.

2. Duplicate `.env.example` in `.env` and fill the file with your desired options.

3. Add the ACF PRO license key in  `auth.json` in `username`.

3. Run `composer install` to download all the plugins.

3. Run `bun install` to download all the libraries and npm modules for gulp.

4. Enjoy

### Commands for Webpack

- Run `bun run dev` when you develop your website. Gulp will watch your file changes.

- Run `bun run build` before deploy the website. This command will compile and minify your files.

---

*Made with passion by [Filippo](https://filippo.im)*