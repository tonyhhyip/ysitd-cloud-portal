import {Environment, FileSystemLoader} from 'nunjucks';
import {basename} from 'path';

const env = new Environment(new FileSystemLoader(`${__dirname}/../../views`, {watch: true}));

env.addGlobal('nodes', [
  {id: 'hkg-1', name: 'HKG - 1'}
]);

function view() {
  return function (file, opts, cb) {
    env.render(basename(file), opts, cb)
  };
}

function register(app) {
  app.engine('jinja', view());
  app.set('view engine', 'jinja');
}

export default view;
export {register};