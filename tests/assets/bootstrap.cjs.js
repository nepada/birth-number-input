import init from '../../dist/commonjs';
import NetteFactory from './netteFactory';

const Nette = NetteFactory();
init(Nette);

export default Nette;
