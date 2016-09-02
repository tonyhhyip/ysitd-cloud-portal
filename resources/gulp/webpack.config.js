import UglifyJsPlugin from 'webpack/lib/optimize/UglifyJsPlugin';
import DedupePlugin from 'webpack/lib/optimize/DedupePlugin';
import CommonChunkPlugin from 'webpack/lib/optimize/CommonsChunkPlugin';
import merge from 'webpack-merge';

const src = './resources/assets/js';

const baseConfig = {
  externals: {
    'react': 'React',
    'react-dom': 'ReactDOM',
    'classnames': 'classNames',
    'vue': 'Vue',
    'vue-resource': 'VueResource',
    'vue-material-components': 'VueMaterialComponents'
  },
  entry: {
    init: `${src}/init.js`,
    app: `${src}/app.js`,
    issue: `${src}/issue.js`
  },
  output: {
    path: 'public/js',
    publicPath: '/js',
    filename: '[name].min.js'
  },
  resolve: {
    extensions: ['', '.js', '.vue'],
    fallback: [`${__dirname}/../../node_modules`],
    alias: {
      'images': 'public/images',
      'public': 'public'
    }
  },
  resolveLoader: {
    fallback: [`${__dirname}/../../node_modules`]
  },
  module: {
    loaders: [
      {
        test: /\.vue$/,
        loader: 'vue'
      },
      {
        test: /\.js$/,
        loader: 'babel'
      },
      {
        test: /\.(png|jpe?g|gif|svg)$/,
        loader: 'url'
      }
    ]
  },
  vue: {
    html: {
      root: 'public'
    }
  }
};


const devConfig = merge(baseConfig, {
  output: {
    filename: '[name].js',
  },
  plugins: [
    new CommonChunkPlugin('init', 'common.js')
  ]
});

const proConfig = merge(baseConfig, {
  plugins: [
    new UglifyJsPlugin({
      minimize: true
    }),
    new DedupePlugin(),
    new CommonChunkPlugin('init', 'common.min.js')
  ]
});

export {devConfig, proConfig};