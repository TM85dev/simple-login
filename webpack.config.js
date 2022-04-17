const path = require('path');
const MiniCssExtractPlugin  = require('mini-css-extract-plugin');

module.exports = {
    devtool: 'source-map',
    entry: {
        login: path.resolve(__dirname, 'assets/ts/login.ts'),
        script: path.resolve(__dirname, 'assets/ts/script.ts'),
    },
    mode: 'development',
    module: {
        rules: [
            {
                test: /\.ts$/,
                use: 'ts-loader',
                include: [path.resolve(__dirname, 'assets/ts')]
            },
            {
                test: /\.s[ac]ss$/i,
                exclude: /node_modules/,
                type: 'asset/resource',
                generator: {
                    filename: 'css/style.css'
                },
                use: 'sass-loader'
            }
        ]
    },
    resolve: {
        extensions: ['.ts', '.js', '.scss', '.css']
    },
    output: {
        path: path.resolve(__dirname, 'public'),
        filename: 'js/[name].js'
    },
    plugins: [
        new MiniCssExtractPlugin({
          filename: "style.css",
        //   chunkFilename: "[id].css"
        })
      ]
}