---
title: vue和react中的组件动态加载
date: 2020-12-30 09:26:20
tags: dynamic
---

## vue和react中的组件动态加载

### vue 的动态组件加载

**首先说下需要注意的:**
动态记载需要加载的路径需要以静态的形式存在, 因为 `babel` 或者 `webpack` 解析的时候, 需要对这些资源文件进行预编译或者加载
举例说明

```javascript

// ok
const Comp1 = ()=> import('@/views/demo/async/components/Comp1')

// NOT ok
const path = '@/views/demo/async/components/Comp1'
const Comp1 = ()=> import(path)

// NOT ok
const name = 'Comp1'
const path = `@/views/demo/async/components${name}`
const Comp1 = ()=> import(path)
```
#### 实现思路

通过传入加载的组件(import) 或者 动态的路径(require实现), 触发组件的 render, 从而动态加载组件

```javascript
<script>
// 动态加载组件
export default {
  name: 'AsyncLoadComp',
  props: {
    // 可以传递动态加载组件的路径名称, 如果传递了, 那么 component 将不生效
    fullPath: {
      type: String,
      default: ''
    },
    // 也可以直接传递组件引用
    component: {
      type: Function,
      default: null
    },
    prop: {
      type: Object,
      default: null
    }
  },
  render(h) {
    const componentHandler = this.fullPath ? require(`${this.fullPath}.vue`) : this.component
    return h(componentHandler, {
      props: {
        prop: this.prop
      }
    })
  }
}
</script>

```

需要结合上边的配置文件一起传入

```vue
<template>
  <div>
      <button @click="load('Comp1')">load1</button>
      <button @click="load('Comp2')">load2</button>
      <div>
          <async-load-comp :component="comp"></async-load-comp>
      </div>
  </div>
</template>

<script>
import config from './async-config'
import AsyncLoadComp from '@/components/AsyncLoadComp'
export default {
    components: {
        AsyncLoadComp
    },
    data() {
        return {
            comp: ()=>import('@/views/async/components/Comp1')
        }
    },
  computed: {
    key() {
      return this.$route.path;
    },
  },
  methods: {
      load(key) {
          this.comp = config[key]
      }
  },
};
</script>
```

#### vue 中的另一种类似的实现方式

```html

<template>
  <component v-if="dynamicComponent" :is="dynamicComponent"></component>
</template>
<script>
export default {
  data() {
    return {
      dynamicComponent: null
    }
  },
  mounted () {
    import('./lib-that-access-window-on-import').then(module => {
      this.dynamicComponent = module.default
    })
  }
}
</script>

```

### react 的动态组件加载

道理是一个样子的, 需要将其作为一个 state 属性进行传递, 触发 render.

```ts
import * as React from 'react';

export default function asyncComponent(importComponent: () => any): React.ComponentClass<any> {

    class AsyncComponent extends React.Component<any, any> {

        constructor(props) {
            super(props);

            this.state = {
                component: null,
            };
        }

        async componentDidMount() {
            const { default: component } = await importComponent();

            this.setState({
                component: component
            });
        }

        render() {
            const C = this.state.component;

            return C
                ? <C {...this.props} />
                : null;
        }

    }

    return AsyncComponent;
}

```

### 后记与总结

动态加载其实就是动态触发, 需要结合一个触发事件然后动态的加载需要的组件内容.

需要注意的是 webpack(babel) 中解析 `import` 的时候, 需要给定具体的路径.

具体的代码参照 [github-vue-async](https://github.com/qszy1210/slog/blob/master/codes/vue-multi/src/views/async/index.vue)

