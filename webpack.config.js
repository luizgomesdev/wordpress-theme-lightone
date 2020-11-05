const path = require('path')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

// Paths
const BUILD_DIR = path.resolve(__dirname, 'public')
const IMG_DIR = path.resolve(__dirname, 'src/assets/img')
const SCSS_DIR = path.resolve(__dirname, 'src/assets/sass')
const JS_DIR = path.resolve(__dirname, 'src/assets/js')

module.exports = (env, argv) => {
	return {
		context: path.resolve(__dirname, 'src'),

		entry: {
			index: [`${JS_DIR}/index.js`, `${SCSS_DIR}/index.scss`],
		},

		output: {
			path: BUILD_DIR,
			filename: 'js/[name].bundle.js',
		},

		module: {
			rules: [
				{
					test: /\.js$/,
					include: [JS_DIR],
					exclude: /node_modules/,
					use: 'babel-loader',
				},
				{
					test: /\.scss$/,
					exclude: /node_modules/,
					use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
				},
				{
					test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
					use: {
						loader: 'file-loader',
						options: {
							name: '[path][name].[ext]',
							publicPath: argv.mode === 'production' ? '../' : '../../',
						},
					},
				},
				{
					test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
					exclude: [IMG_DIR, /node_modules/],
					use: {
						loader: 'file-loader',
						options: {
							name: '[path][name].[ext]',
							publicPath: argv.mode === 'production' ? '../' : '../../',
						},
					},
				},
			],
		},

		devtool: 'source-map',

		plugins: [
			new CleanWebpackPlugin({
				cleanStaleWebpackAssets: argv.mode === 'production',
			}),
			new MiniCssExtractPlugin({
				filename: 'css/[name].css',
			}),
			new BrowserSyncPlugin({
				files: '**/*.php',
				proxy: 'http://blog.dev.tangerino.com.br',
			}),
		],

		externals: {
			jquery: 'jQuery',
		},

		optimization: {
			minimizer: [new UglifyJsPlugin({ cache: false, parallel: true, sourceMap: false })],
		},
	}
}
