<template>
    <v-card>
        <v-card-title primary-title class="grey lighten-4">
            <h3 class="headline mb-0">MWS</h3>
        </v-card-title>
        <v-divider></v-divider>
        <div>
          <div class="col-md-3">

      <div class="panel panel-default">
        <div class="panel-heading">Props</div>

        <div class="panel-body">
            <div class="form-horizontal">

            <div class="form-group">
              <label for="type" class="control-label col-sm-3">type</label>
                <div  class="col-sm-9">
                  <select id="type" class="form-control" v-model="type">
                    <option>tree</option>
                    <option>cluster</option>
                  </select>
                </div>
            </div>

            <div class="form-group">
              <label for="layout-type" class="control-label col-sm-3">layoutType</label>
                <div  class="col-sm-9">
                  <select id="layout-type" class="form-control" v-model="layoutType">
                    <option>euclidean</option>
                    <option>circular</option>
                  </select>       
              </div>
            </div> 

            <div class="form-group">
              <label for="margin-x" class="control-label col-sm-3">marginx</label>
              <div class="col-sm-7">
                <input id="margin-x" class="form-control" type="range" min="-200" max="200" v-model.number="Marginx">
              </div> 
                <div class="col-sm-2">
                  <p>{{Marginx}}px</p>       
              </div> 
            </div>        

            <div class="form-group">
              <label for="margin-y" class="control-label col-sm-3">marginy</label>
              <div class="col-sm-7">
                <input id="margin-y" class="form-control" type="range" min="-200" max="200" v-model.number="Marginy">
              </div>
              <div class="col-sm-2">
                <p>{{Marginy}}px</p>       
              </div> 
            </div>   

             <div class="form-group">
              <label for="margin-y" class="control-label col-sm-3">radius</label>
              <div class="col-sm-7">
                <input id="margin-y" class="form-control" type="range" min="1" max="10" v-model.number="radius">
              </div>
              <div class="col-sm-2">
                <p>{{radius}}px</p>       
              </div> 
            </div>        

            <div class="form-group">
              <label for="velocity" class="control-label col-sm-3">Duration</label>
              <div class="col-sm-7">
                <input id="velocity" class="form-control" type="range" min="0" max="3000" v-model.number="duration">
              </div>
              <div class="col-sm-2">
                <p>{{duration}}ms</p>       
              </div>
            </div>  

            <div class="form-group">
              <span v-if="currentNode">Current Node: {{currentNode.data.text}}</span>
              <span v-else>No Node selected.</span>
               <i v-if="isLoading" class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
            </div>  

            <button type="button" :disabled="!currentNode" class="btn btn-primary" @click="expandAll" data-toggle="tooltip" data-placement="top" title="Expand All from current">
            <i class="fa fa-expand" aria-hidden="true"></i>          
            </button>

            <button type="button" :disabled="!currentNode" class="btn btn-secondary" @click="collapseAll" data-toggle="tooltip" data-placement="top" title="Collapse All from current">
            <i class="fa fa-compress" aria-hidden="true"></i>            
            </button>

            <button type="button" :disabled="!currentNode" class="btn btn-success" @click="showOnly" data-toggle="tooltip" data-placement="top" title="Show Only from current">
            <i class="fa fa-search-plus" aria-hidden="true"></i>       
            </button>

            <button type="button" :disabled="!currentNode" class="btn btn-warning" @click="show" data-toggle="tooltip" data-placement="top" title="Show current">
            <i class="fa fa-binoculars" aria-hidden="true"></i>           
            </button>

            <button v-if="zoomable" type="button" class="btn btn-warning" @click="resetZoom" data-toggle="tooltip" data-placement="top" title="Reset Zoom">
            <i class="fa fa-arrows-alt" aria-hidden="true"></i>                             
            </button>

        </div>
      </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">Events</div>

        <div class="panel-body log">
          <div v-for="(event,index) in events" :key="index">
            <p><b>Name:</b> {{event.eventName}} <b>Data:</b>{{event.data.text}}</p>
          </div>
        </div>
    </div>

  </div>

  <div class="col-md-9 panel panel-default">
    <tree ref="tree" :identifier="getId" :zoomable="zoomable" :data="Graph.tree" :node-text="nodeText"  :margin-x="Marginx" :margin-y="Marginy" :radius="radius" :type="type" :layout-type="layoutType" :duration="duration" class="tree" @clicked="onClick" @expand="onExpand" @retract="onRetract"/>
  </div>
        </div> 
    </v-card>
</template>

<script>
let data = {"Graph":{"tree":{"children":[{"children":[{"children":[{"children":[{"children":[],"id":53,"text":"DiscogsEntityType"},{"children":[],"id":50,"text":"DiscogsImageFormatType"},{"children":[],"id":52,"text":"DiscogsPaginable"},{"children":[],"id":54,"text":"DiscogsSearch"},{"children":[],"id":51,"text":"DiscogsSortInformation"}],"id":49,"text":"Query"},{"children":[{"children":[],"id":14,"text":"DiscogsArtist"},{"children":[],"id":13,"text":"DiscogsArtistRelease"},{"children":[],"id":46,"text":"DiscogsArtistReleases"},{"children":[],"id":23,"text":"DiscogsArtistSortType"},{"children":[],"id":27,"text":"DiscogsCommunity"},{"children":[],"id":26,"text":"DiscogsCommunityInfo"},{"children":[],"id":15,"text":"DiscogsCommunityReleaseRating"},{"children":[],"id":28,"text":"DiscogsEntity"},{"children":[],"id":29,"text":"DiscogsFormat"},{"children":[],"id":22,"text":"DiscogsGroupOrBandMember"},{"children":[],"id":30,"text":"DiscogsIdentifier"},{"children":[],"id":16,"text":"DiscogsIdentity"},{"children":[],"id":40,"text":"DiscogsImage"},{"children":[],"id":31,"text":"DiscogsImageType"},{"children":[],"id":32,"text":"DiscogsLabel"},{"children":[],"id":17,"text":"DiscogsLabelRelease"},{"children":[],"id":48,"text":"DiscogsLabelReleases"},{"children":[],"id":24,"text":"DiscogsMaster"},{"children":[],"id":19,"text":"DiscogsPaginableResults`1"},{"children":[],"id":33,"text":"DiscogsPaginedResult"},{"children":[],"id":34,"text":"DiscogsPaginedUrls"},{"children":[],"id":25,"text":"DiscogsRating"},{"children":[],"id":41,"text":"DiscogsRelease"},{"children":[],"id":39,"text":"DiscogsReleaseArtist"},{"children":[],"id":35,"text":"DiscogsReleaseBase"},{"children":[],"id":18,"text":"DiscogsReleaseLabel"},{"children":[],"id":20,"text":"DiscogsReleaseRating"},{"children":[],"id":44,"text":"DiscogsReleaseVersion"},{"children":[],"id":47,"text":"DiscogsReleaseVersions"},{"children":[],"id":36,"text":"DiscogsSearchResult"},{"children":[],"id":42,"text":"DiscogsSearchResults"},{"children":[],"id":37,"text":"DiscogsSimplifiedLabel"},{"children":[],"id":21,"text":"DiscogsSortOrderType"},{"children":[],"id":38,"text":"DiscogsTrack"},{"children":[],"id":43,"text":"DiscogsUser"},{"children":[],"id":45,"text":"DiscogsVideo"}],"id":12,"text":"Result"}],"id":11,"text":"Data"},{"children":[{"children":[],"id":9,"text":"DiscogsWebClient"},{"children":[],"id":10,"text":"IDiscogsWebClient"}],"id":8,"text":"Internal"},{"children":[],"id":2,"text":"DiscogsAuthentifierClient"},{"children":[],"id":3,"text":"DiscogsClient"},{"children":[],"id":4,"text":"DiscogsException"},{"children":[],"id":5,"text":"IDiscogsDataBaseClient"},{"children":[],"id":6,"text":"IDiscogsReleaseRatingClient"},{"children":[],"id":7,"text":"IDiscogsUserIdentityClient"}],"id":1,"text":"DiscogsClient"}],"id":0,"text":"DiscogsClient"},"links":[{"source":3,"target":5,"value":4},{"source":3,"target":6,"value":4},{"source":3,"target":7,"value":4},{"source":3,"target":10,"value":2},{"source":3,"target":13,"value":2},{"source":3,"target":14,"value":2},{"source":3,"target":15,"value":2},{"source":3,"target":16,"value":2},{"source":3,"target":17,"value":2},{"source":3,"target":20,"value":2},{"source":3,"target":24,"value":2},{"source":3,"target":32,"value":2},{"source":3,"target":36,"value":2},{"source":3,"target":40,"value":2},{"source":3,"target":41,"value":2},{"source":3,"target":44,"value":2},{"source":3,"target":50,"value":2},{"source":3,"target":51,"value":2},{"source":3,"target":52,"value":1},{"source":3,"target":54,"value":2},{"source":5,"target":6,"value":4},{"source":5,"target":13,"value":2},{"source":5,"target":14,"value":2},{"source":5,"target":17,"value":2},{"source":5,"target":24,"value":2},{"source":5,"target":32,"value":2},{"source":5,"target":36,"value":2},{"source":5,"target":40,"value":2},{"source":5,"target":41,"value":2},{"source":5,"target":44,"value":2},{"source":5,"target":50,"value":2},{"source":5,"target":51,"value":2},{"source":5,"target":54,"value":2},{"source":6,"target":15,"value":2},{"source":6,"target":20,"value":2},{"source":7,"target":16,"value":2},{"source":9,"target":10,"value":4},{"source":13,"target":28,"value":4},{"source":14,"target":28,"value":4},{"source":15,"target":25,"value":2},{"source":16,"target":28,"value":4},{"source":17,"target":28,"value":4},{"source":18,"target":28,"value":4},{"source":19,"target":33,"value":2},{"source":22,"target":28,"value":4},{"source":24,"target":35,"value":4},{"source":27,"target":25,"value":2},{"source":27,"target":26,"value":4},{"source":27,"target":43,"value":2},{"source":32,"target":28,"value":4},{"source":32,"target":37,"value":2},{"source":33,"target":34,"value":2},{"source":35,"target":28,"value":4},{"source":36,"target":26,"value":2},{"source":36,"target":28,"value":4},{"source":36,"target":53,"value":2},{"source":37,"target":28,"value":4},{"source":39,"target":28,"value":4},{"source":40,"target":31,"value":2},{"source":41,"target":27,"value":2},{"source":41,"target":35,"value":4},{"source":44,"target":28,"value":4},{"source":51,"target":21,"value":2},{"source":51,"target":23,"value":2},{"source":54,"target":53,"value":2}],"text":"DiscogsClient"}}

Object.assign(data, {
  type: 'tree',
  layoutType: 'euclidean',
  duration: 750,
  Marginx: 30,
  Marginy: 30,
  radius: 5,
  nodeText: 'text',
  currentNode: null,
  zoomable: true,
  isLoading: false,
  events: []
})

import {tree} from 'vued3tree'
  export default {
    name: 'index',
    components: {
    tree
  },
  data () {
    return data
  },
  components: {
    tree
  },
  methods: {
    do (action) {
      if (this.currentNode) {
        this.isLoading = true
        this.$refs['tree'][action](this.currentNode).then(() => { this.isLoading = false })
      }
    },
    getId (node) {
      return node.id
    },
    expandAll () {
      this.do('expandAll')
    },
    collapseAll () {
      this.do('collapseAll')
    },
    showOnly () {
      this.do('showOnly')
    },
    show () {
      this.do('show')
    },
    onClick (evt) {
      this.currentNode = evt.element
      this.onEvent('onClick', evt)
    },
    onExpand (evt) {
      this.onEvent('onExpand', evt)
    },
    onRetract (evt) {
      this.onEvent('onRetract', evt)
    },
    onEvent (eventName, data) {
      this.events.push({eventName, data: data.data})
      console.log({eventName, data: data})
    },
    resetZoom () {
      this.isLoading = true
      this.$refs['tree'].resetZoom().then(() => { this.isLoading = false })
    }
  }
  }
</script>

<style scoped>

</style>